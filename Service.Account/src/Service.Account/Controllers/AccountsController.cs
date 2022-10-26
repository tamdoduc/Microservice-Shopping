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
        private readonly IRepository<AccountDao> accountsRepository;

        public AccountsController(IRepository<AccountDao> accountsRepository)
        {
            this.accountsRepository = accountsRepository;
        }

        //GET /accounts/
        [HttpGet]
        public async Task<ActionResult<IEnumerable<AccountDto>>> GetAsync()
        {
            var accounts = (await accountsRepository.GetAllAsync()).Select(item => item.AsDto());

            return Ok(accounts);
        }

        //GET /accounts/{id}
        [HttpGet("{id}")]
        public async Task<ActionResult<IEnumerable<AccountDto>>> GetAsyncById(Guid id)
        {
            if (id == Guid.Empty)
            {
                return BadRequest();
            }
            var accounts = (
                await accountsRepository.GetAllAsync(account => account.Id == id)
            ).Select(account => account.AsDto());

            return Ok(accounts);
        }

        //POST /accounts/
        [HttpPost]
        public async Task<ActionResult<AccountDto>> PostAsync(CreateAccountDto createItemDto)
        {
            var account = new AccountDao
            {
                UserName = createItemDto.UserName,
                Password = createItemDto.Password,
                FullName = createItemDto.FullName,
                Email = createItemDto.Email,
                PhoneNumber = createItemDto.PhoneNumber,
                ImageUrl = "",
                Sex = createItemDto.Sex
            };
            await accountsRepository.CreateAsync(account);
            return CreatedAtAction(nameof(GetAsyncById), new { id = account.Id }, account);
        }

        //PUT /accounts/{id}
        [HttpPut("{id}")]
        public async Task<IActionResult> PutAsync(Guid id, UpdateAccountDto updateAccountDto)
        {
            var existingAccount = await accountsRepository.GetAsync(id);

            if (existingAccount == null)
            {
                return NotFound();
            }

            existingAccount.UserName = updateAccountDto.UserName;
            existingAccount.Password = updateAccountDto.Password;
            existingAccount.FullName = updateAccountDto.FullName;
            existingAccount.Email = updateAccountDto.Email;
            existingAccount.PhoneNumber = updateAccountDto.PhoneNumber;
            existingAccount.ImageUrl = updateAccountDto.ImageUrl;
            existingAccount.Sex = updateAccountDto.Sex;

            await accountsRepository.UpdateAsync(existingAccount);

            return NoContent();
        }

        //DELETE /accounts/{id}
        [HttpDelete("{id}")]
        public async Task<IActionResult> DeleteAsync(Guid id)
        {
            var item = await accountsRepository.GetAsync(id);
            if (item == null)
            {
                return NotFound();
            }

            await accountsRepository.RemoveAsync(item.Id);
            return NoContent();
        }
    }
}
