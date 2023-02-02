using Microsoft.AspNetCore.Mvc;
using Account.Service.Entities;
using System.Threading.Tasks;
using System;
using System.Collections.Generic;
using Account.Service.Dtos;
using System.Linq;
using MassTransit;
using Account.Contracts;
using Base.Service;

namespace Account.Service.Controllers
{
    [ApiController]
    [Route("accounts")]
    public class AccountsController : ControllerBase
    {
        private readonly IRepository<AccountDao> accountsRepository;
        private readonly IPublishEndpoint publishEndpoint;

        public AccountsController(
            IRepository<AccountDao> accountsRepository,
            IPublishEndpoint publishEndpoint
        )
        {
            this.accountsRepository = accountsRepository;
            this.publishEndpoint = publishEndpoint;
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

            await publishEndpoint.Publish(
                new AccountCreated(
                    account.Id,
                    account.UserName,
                    account.Password,
                    account.FullName,
                    account.Email,
                    account.PhoneNumber,
                    account.ImageUrl,
                    account.Sex
                )
            );

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

            await publishEndpoint.Publish(
                new AccountUpdated(
                    existingAccount.Id,
                    existingAccount.UserName,
                    existingAccount.Password,
                    existingAccount.FullName,
                    existingAccount.Email,
                    existingAccount.PhoneNumber,
                    existingAccount.ImageUrl,
                    existingAccount.Sex
                )
            );

            return NoContent();
        }

        //DELETE /accounts/{id}
        [HttpDelete("{id}")]
        public async Task<IActionResult> DeleteAsync(Guid id)
        {
            var account = await accountsRepository.GetAsync(id);
            if (account == null)
            {
                return NotFound();
            }

            await accountsRepository.RemoveAsync(account.Id);

            await publishEndpoint.Publish(new AccountDeleted(account.Id));

            return NoContent();
        }
    }
}
