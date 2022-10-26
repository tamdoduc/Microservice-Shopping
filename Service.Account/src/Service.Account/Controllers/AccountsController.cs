using Microsoft.AspNetCore.Mvc;
using Service.Account.Entities;
using Service.Account;
using Base.Service;
using System.Threading.Tasks;
using System;
using System.Collections.Generic;
using Service.Account.Dtos;
using System.Linq;

namespace Base.Service.Controllers
{
    [ApiController]
    [Route("accounts")]
    public class AccountsController : ControllerBase
    {
        private readonly IRepository<Account> accountsRepository;

        public AccountsController(IRepository<Account> accountsRepository)
        {
            this.accountsRepository = accountsRepository;
        }

        [HttpGet]
        public async Task<ActionResult<IEnumerable<AccountDto>>> GetAsync(Guid userId)
        {
            if (userId == Guid.Empty)
            {
                return BadRequest();
            }

            var accounts = (
                await accountsRepository.GetAllAsync(account => account.Id == userId)
            ).Select(account => account.AsDto());
        }
    }
}
