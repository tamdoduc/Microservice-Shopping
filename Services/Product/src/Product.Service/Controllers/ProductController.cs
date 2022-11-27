using Base.Service;
using Product.Service.Entities;
using Microsoft.AspNetCore.Mvc;
using System.Threading.Tasks;
using System.Collections.Generic;
using Product.Service.Dtos;
using System;
using System.Linq;
using MassTransit;

namespace Product.Service.Controllers
{
    [ApiController]
    [Route("products")]
        public class ProductController : ControllerBase
    {
        protected readonly IRepository<ProductDao> productsRepository;
        protected readonly IPublishEndpoint publishEndpoint;

        public ProductController(IRepository<ProductDao> productsRepository,IPublishEndpoint publishEndpoint)
        {
            this.productsRepository = productsRepository;
            this.publishEndpoint = publishEndpoint;
        }

         //GET /products/byAccount/{idAccount}
        [HttpGet("byAccount/{idAccount}")]
        public async Task<ActionResult<IEnumerable<ProductDto>>> GetAllAsyncByIdAccount(Guid idAccount)
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
        //GET /products
        [HttpGet]
        public async Task<ActionResult<IEnumerable<ProductDto>>> GetAllAsync()
        {
            var products = (
                await productsRepository.GetAllAsync()
            ).Select(product => product.AsDto());

            return Ok(products);
        }
         //GET /products/{id}
        [HttpGet("{id}")]
        public async Task<ActionResult<IEnumerable<ProductDto>>> GetAsyncById(Guid id)
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
        //POST /products/
        [HttpPost]
        public async Task<ActionResult<ProductDto>> PostAsync(CreateProductDto productDto)
        {
            var product = new ProductDao
            {
                IdAccount = productDto.IdAccount,
                NameProduct = productDto.NameProduct,
                Image = productDto.Image,
                MinPrice = productDto.MinPrice,
                MaxPrice = productDto.MaxPrice,
                CountSold = productDto.CountSold,
                CountStar = productDto.CountStar,
                Discount = productDto.Discount
            };
            await productsRepository.CreateAsync(product);

            return CreatedAtAction(nameof(GetAsyncById), new { id = product.Id }, product);
        }
         //PUT /products/{id}
        [HttpPut("{id}")]
        public async Task<IActionResult> PutAsync(Guid id, UpdateProductDto productDto)
        {
            var existingProduct = await productsRepository.GetAsync(id);

            if (existingProduct == null)
            {
                return NotFound();
            }
            existingProduct.IdAccount = productDto.IdAccount;
            existingProduct.NameProduct = productDto.NameProduct;
            existingProduct.Image = productDto.Image;
            existingProduct.MinPrice = productDto.MinPrice;
            existingProduct.MaxPrice = productDto.MaxPrice;
            existingProduct.CountSold = productDto.CountSold;
            existingProduct.CountStar = productDto.CountStar;
            existingProduct.Discount = productDto.Discount;
            await productsRepository.UpdateAsync(existingProduct);

            return NoContent();
        }
        //DELETE /products/{id}
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