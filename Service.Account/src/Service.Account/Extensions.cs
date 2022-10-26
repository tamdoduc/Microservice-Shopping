using Service.Account.Dtos;
using Service.Account.Entities;

namespace Service.Account
{
    public static class Extensions
    {
        public static AccountDto AsDto(this Service.Account.Entities.AccountDao account)
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
