using Service.Account.Dtos;

namespace Service.Account
{
    public static class Extensions
    {
        public static AccountDto AsDto(this AccountDto account)
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
