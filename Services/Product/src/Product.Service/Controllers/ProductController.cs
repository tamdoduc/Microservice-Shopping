using Base.Service;
using Product.Service.Entities;
using Microsoft.AspNetCore.Mvc;
using System.Threading.Tasks;
using System.Collections.Generic;
using Product.Service.Dtos;
using System;
using System.Linq;

namespace Product.Service.Controllers
{
    [ApiController]
    [Route("products")]
    public class ProductController : ControllerBase
    {
        private readonly IRepository<ProductDao> productsRepository;

        public ProductController(IRepository<ProductDao> productsRepository)
        {
            this.productsRepository = productsRepository;
        }

         //GET /products/{idAccount}
        [HttpGet("{idAccount}")]
        public async Task<ActionResult<IEnumerable<ProductDto>>> GetAsyncById(Guid idAccount)
        {
            if (idAccount == Guid.Empty)
            {
                return BadRequest();
            }
            var products = (
                await productsRepository.GetAllAsync(product => product.IdAccount == idAccount)
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
            var account = await productsRepository.GetAsync(id);
            if (account == null)
            {
                return NotFound();
            }

            await productsRepository.RemoveAsync(account.Id);

            return NoContent();
        }
    }
}