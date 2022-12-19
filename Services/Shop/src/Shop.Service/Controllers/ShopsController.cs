using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using MassTransit;
using Microsoft.AspNetCore.Mvc;
using Play.Common;
using Shop.Service.Dtos;
using Shop.Service.Entities;

namespace Shop.Service.Controllers
{
    [ApiController]
    [Route("shops")]
    public class ItemsController : ControllerBase
    {
        protected readonly IRepository<ShopDao> shopRepository;
        public ItemsController(IRepository<ShopDao> shopRepository)
        {
            this.shopRepository = shopRepository;
        }

        [HttpGet]
        public async Task<ActionResult<IEnumerable<ShopDto>>> GetAllAsync()
        {

            var shops = (await shopRepository.GetAllAsync())
                .Select(shop => shop.AsDto());

            return Ok(shops);
        }

        [HttpGet("{shopId}")]
        public async Task<ActionResult<IEnumerable<ShopDto>>> GetAsyncById(Guid shopId)
        {
            if (shopId == null || shopId == Guid.Empty)
            {
                return BadRequest();
            }

            var shops = (await shopRepository.GetAllAsync(item => item.Id == shopId))
                .Select(shop => shop.AsDto());

            return Ok(shops);
        }

        [HttpGet("byAccount/{accountId}")]
        public async Task<ActionResult<IEnumerable<ShopDto>>> GetByAccountIdAsync(Guid accountId)
        {
            if (accountId == null || accountId == Guid.Empty)
            {
                return BadRequest();
            }

            var shops = (await shopRepository.GetAllAsync(item => item.AccountId == accountId))
                .Select(shop => shop.AsDto());

            return Ok(shops);
        }
        //POST /shops/
        [HttpPost]
        public async Task<ActionResult<ShopDto>> PostAsync(CreateShopDto shopDto)
        {
            var shop = new ShopDao
            {
                AccountId = shopDto.AccountId,
                Name = shopDto.Name,
                EvaluationCount = 0,
                StarRating = 5,
                JoinDate = DateTime.Today,
                ProductCount = 0,
                FollowerCount = 0
            };
            await shopRepository.CreateAsync(shop);

            return Ok(shop);
        }

        [HttpPut("{id}")]
        public async Task<IActionResult> PutAsync(Guid id, UpdateShopDto shopDto)
        {
            var existingShop = await shopRepository.GetAsync(id);

            if (existingShop == null)
            {
                return NotFound();
            }
            existingShop.AccountId = shopDto.AccountId;
            existingShop.Name = shopDto.Name;
            existingShop.EvaluationCount = shopDto.EvaluationCount;
            existingShop.StarRating = shopDto.StarRating;
            existingShop.JoinDate = shopDto.JoinDate;
            existingShop.ProductCount = shopDto.ProductCount;
            existingShop.FollowerCount = shopDto.FollowerCount;

            await shopRepository.UpdateAsync(existingShop);

            return Ok(existingShop);
        }

        //DELETE /products/{id}
        [HttpDelete("{id}")]
        public async Task<IActionResult> DeleteAsync(Guid id)
        {
            var product = await shopRepository.GetAsync(id);
            if (product == null)
            {
                return NotFound();
            }

            await shopRepository.RemoveAsync(product.Id);

            return Ok();
        }
    }

}