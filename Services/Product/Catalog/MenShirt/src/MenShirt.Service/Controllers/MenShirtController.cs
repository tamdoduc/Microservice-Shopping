using Base.Service;
using MassTransit;
using Microsoft.AspNetCore.Mvc;
using Product.Service.Controllers;
using Product.Service.Entities;

namespace Product.Catalog.MenShirt.Controllers
{
    [Route("catalog/menshirts")]
    public class MenShirtController : ProductController
    {
        public MenShirtController(IRepository<MenShirtDao> productsRepository, IPublishEndpoint publishEndpoint)
        {
        }
    }
}