using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using Microsoft.AspNetCore.Http;

[ApiController]
[Route("api/[controller]")]
public class AuthController : ControllerBase
{
    private readonly DocumentContext _context;
    private const string SessionKeyUserId = "UserId";

    public AuthController(DocumentContext context)
    {
        _context = context;
    }

    [HttpPost("login")]
    public async Task<IActionResult> Login([FromBody] LoginRequest request)
    {
        var user = await _context.Users.FirstOrDefaultAsync(u => u.Username == request.Username && u.Password == request.Password);
        if (user == null)
        {
            return Unauthorized(new { message = "Invalid username or password" });
        }
        HttpContext.Session.SetInt32(SessionKeyUserId, user.Id);
        return Ok(new { message = "Login successful" });
    }

    [HttpPost("logout")]
    public IActionResult Logout()
    {
        HttpContext.Session.Remove(SessionKeyUserId);
        return Ok(new { message = "Logged out" });
    }

    [HttpGet("session")]
    public IActionResult CheckSession()
    {
        var userId = HttpContext.Session.GetInt32(SessionKeyUserId);
        if (userId == null)
        {
            return Unauthorized();
        }
        return Ok(new { userId });
    }

    [HttpPost("register")]
    public async Task<IActionResult> Register([FromBody] LoginRequest request)
    {
        var exists = await _context.Users.AnyAsync(u => u.Username == request.Username);
        if (exists)
        {
            return BadRequest(new { message = "Username already exists" });
        }
        var user = new User { Username = request.Username, Password = request.Password };
        _context.Users.Add(user);
        await _context.SaveChangesAsync();
        return Ok(new { message = "User registered" });
    }
}

public class LoginRequest
{
    public string Username { get; set; }
    public string Password { get; set; }
}
