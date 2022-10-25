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
}
