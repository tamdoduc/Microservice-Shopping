using System;

namespace Service.Account.Dtos
{
    public record AccountDto(
        Guid Id,
        string UserName,
        string Password,
        string FullName,
        string Email,
        int PhoneNumber,
        string ImageUrl,
        string Sex
    );

    public record CreateAccountDto(
        string UserName,
        string Password,
        string FullName,
        string Email,
        int PhoneNumber,
        string Sex
    );

    public record UpdateAccountDto(
        string UserName,
        string Password,
        string FullName,
        string Email,
        int PhoneNumber,
        string ImageUrl,
        string Sex
    );
}
