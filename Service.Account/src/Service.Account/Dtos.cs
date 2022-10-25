using System;

namespace Service.Account.Dtos
{
    public record AccountDto(
        Guid id,
        string userName,
        string password,
        string fullName,
        string email,
        int phoneNumber,
        string imageUrl,
        string sex
    );
}
