using System;
using Base.Service;

namespace Account.Service.Entities
{
    public class AccountDao : IEntity
    {
        public Guid Id { get; set; }
        public string UserName { get; set; }
        public string Password { get; set; }
        public string FullName { get; set; }
        public string Email { get; set; }
        public int PhoneNumber { get; set; }
        public string ImageUrl { get; set; }
        public string Sex { get; set; }
    }
}
