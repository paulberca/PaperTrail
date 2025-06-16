using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using System.Linq;

[ApiController]
[Route("api/[controller]")]
public class DocumentsController : ControllerBase
{
    private readonly DocumentContext _context;
    public DocumentsController(DocumentContext context)
    {
        _context = context;
    }

    private bool IsAuthenticated()
    {
        return HttpContext.Session.GetInt32("UserId") != null;
    }

    // GET: api/documents?type=...&format=...
    [HttpGet]
    public async Task<IActionResult> GetFilteredDocuments([FromQuery] string type = null, [FromQuery] string format = null)
    {
        if (!IsAuthenticated()) return Unauthorized();
        var query = _context.Documents.AsQueryable();
        if (!string.IsNullOrEmpty(type))
            query = query.Where(d => d.Type == type);
        if (!string.IsNullOrEmpty(format))
            query = query.Where(d => d.Format == format);
        var documents = await query.ToListAsync();
        return Ok(documents);
    }

    // GET: api/documents/stats
    [HttpGet("stats")]
    public async Task<IActionResult> GetDocumentStats()
    {
        if (!IsAuthenticated()) return Unauthorized();
        var stats = await _context.Documents
            .GroupBy(d => d.Type)
            .Select(g => new
            {
                type = g.Key,
                total_documents = g.Count(),
                total_pages = g.Sum(d => d.Pages),
                avg_pages = g.Average(d => d.Pages),
                min_pages = g.Min(d => d.Pages),
                max_pages = g.Max(d => d.Pages),
                unique_authors = g.Select(d => d.Author).Distinct().Count(),
                unique_formats = g.Select(d => d.Format).Distinct().Count()
            })
            .OrderByDescending(s => s.total_documents)
            .ToListAsync();
        return Ok(stats);
    }

    // POST: api/documents
    [HttpPost]
    public async Task<IActionResult> AddDocument([FromBody] Document doc)
    {
        if (!IsAuthenticated()) return Unauthorized();
        _context.Documents.Add(doc);
        await _context.SaveChangesAsync();
        return Ok(new { success = true });
    }

    // PUT: api/documents/{id}
    [HttpPut("{id}")]
    public async Task<IActionResult> UpdateDocument(int id, [FromBody] Document doc)
    {
        if (!IsAuthenticated()) return Unauthorized();
        var existing = await _context.Documents.FindAsync(id);
        if (existing == null)
            return NotFound(new { error = "Document not found" });
        existing.Author = doc.Author;
        existing.Title = doc.Title;
        existing.Pages = doc.Pages;
        existing.Type = doc.Type;
        existing.Format = doc.Format;
        await _context.SaveChangesAsync();
        return Ok(new { success = true });
    }

    // DELETE: api/documents/{id}
    [HttpDelete("{id}")]
    public async Task<IActionResult> DeleteDocument(int id)
    {
        if (!IsAuthenticated()) return Unauthorized();
        var doc = await _context.Documents.FindAsync(id);
        if (doc == null)
            return NotFound(new { error = "Document not found" });
        _context.Documents.Remove(doc);
        await _context.SaveChangesAsync();
        return Ok(new { success = true });
    }

    // GET: api/documents/options
    [HttpGet("options")]
    public IActionResult GetDocumentOptions()
    {
        if (!IsAuthenticated()) return Unauthorized();
        var data = new
        {
            types = new[] { "Report", "Invoice", "Letter", "Research Paper", "Memo" },
            formats = new[] { "PDF", "DOCX", "TXT", "ODT" }
        };
        return Ok(data);
    }
}
