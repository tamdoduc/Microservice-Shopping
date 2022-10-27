using System;

namespace Account.Contracts
{
    public record AccountCreated(
        Guid Id,
        string UserName,
        string Password,
        string FullName,
        string Email,
        int PhoneNumber,
        string ImageUrl,
        string sex
    );

    public record AccountUpdated(
        Guid Id,
        string UserName,
        string Password,
        string FullName,
        string Email,
        int PhoneNumber,
        string ImageUrl,
        string sex
    );

    public record AccountDeleted(Guid Id);
}
