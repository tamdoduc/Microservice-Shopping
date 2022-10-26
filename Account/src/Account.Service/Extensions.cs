using Account.Service.Dtos;
using Account.Service.Entities;

namespace Account.Service
{
    public static class Extensions
    {
        public static AccountDto AsDto(this AccountDao account)
        {
            return new AccountDto(
                account.Id,
                account.UserName,
                account.Password,
                account.FullName,
                account.Email,
                account.PhoneNumber,
                account.ImageUrl,
                account.Sex
            );
        }
    }
}
