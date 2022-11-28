using Base.Service;
using Microsoft.AspNetCore.Mvc;
using MassTransit;
using Product.Catalog.MenShirt.Service.Entities;
using System.Threading.Tasks;
using System;
using Product.Catalog.MenShirt.Service.Dtos;
using System.Linq;
using Product.Catalog.MenShirt.Service.Extensions;
using System.Collections.Generic;

namespace Product.Catalog.MenShirt.Service.Controllers
{
    [ApiController]
    [Route("product/catalog/menshirts")]
    public class MenShirtController : ControllerBase
    {
        private readonly IRepository<MenShirtDao> productsRepository;
        private readonly IPublishEndpoint publishEndpoint;
        public MenShirtController(IRepository<MenShirtDao> productsRepository,IPublishEndpoint publishEndpoint)
        {
            this.productsRepository = productsRepository;
            this.publishEndpoint = publishEndpoint;
        }
         //GET /product/catalog/menshirts/byAccount/{idAccount}
        [HttpGet("byAccount/{idAccount}")]
        public async Task<ActionResult<IEnumerable<MenShirtDto>>> GetAllAsyncByIdAccount(Guid idAccount)
        {
            if (idAccount == Guid.Empty)
            {
                return BadRequest("123");
            }
            var products = (
                await productsRepository.GetAllAsync(product => product.IdAccount == idAccount)
            ).Select(product => product.AsDto());

            return Ok(products);
        }
        //GET /product/catalog/menshirts
        [HttpGet]
        public async Task<ActionResult<IEnumerable<MenShirtDto>>> GetAllAsync()
        {
            var products = (
                await productsRepository.GetAllAsync()
            ).Select(product => product.AsDto());

            return Ok(products);
        }
         //GET /product/catalog/menshirts/{id}
        [HttpGet("{id}")]
        public async Task<ActionResult<IEnumerable<MenShirtDto>>> GetAsyncById(Guid id)
        {
            if (id == Guid.Empty)
            {
                return BadRequest();
            }
            var products = (
                await productsRepository.GetAllAsync(product => product.Id == id)
            ).Select(product => product.AsDto());

            return Ok(products);
        }
        //POST /product/catalog/menshirts/
        [HttpPost]
        public async Task<ActionResult<MenShirtDto>> PostAsync(CreateMenShirtDto MenShirtDto)
        {
            var product = new MenShirtDao
            {
                IdAccount = MenShirtDto.IdAccount,
                NameProduct = MenShirtDto.NameProduct,
                Image = MenShirtDto.Image,
                MinPrice = MenShirtDto.MinPrice,
                MaxPrice = MenShirtDto.MaxPrice,
                CountSold = MenShirtDto.CountSold,
                CountStar = MenShirtDto.CountStar,
                Discount = MenShirtDto.Discount
            };
            await productsRepository.CreateAsync(product);

            return CreatedAtAction(nameof(GetAsyncById), new { id = product.Id }, product);
        }
         //PUT /product/catalog/menshirts/{id}
        [HttpPut("{id}")]
        public async Task<IActionResult> PutAsync(Guid id, UpdateMenShirtDto MenShirtDto)
        {
            var existingProduct = await productsRepository.GetAsync(id);

            if (existingProduct == null)
            {
                return NotFound();
            }
            existingProduct.IdAccount = MenShirtDto.IdAccount;
            existingProduct.NameProduct = MenShirtDto.NameProduct;
            existingProduct.Image = MenShirtDto.Image;
            existingProduct.MinPrice = MenShirtDto.MinPrice;
            existingProduct.MaxPrice = MenShirtDto.MaxPrice;
            existingProduct.CountSold = MenShirtDto.CountSold;
            existingProduct.CountStar = MenShirtDto.CountStar;
            existingProduct.Discount = MenShirtDto.Discount;
            await productsRepository.UpdateAsync(existingProduct);

            return NoContent();
        }
        //DELETE /product/catalog/menshirts/{id}
        [HttpDelete("{id}")]
        public async Task<IActionResult> DeleteAsync(Guid id)
        {
            var product = await productsRepository.GetAsync(id);
            if (product == null)
            {
                return NotFound();
            }

            await productsRepository.RemoveAsync(product.Id);

            return NoContent();
        }
    }
}