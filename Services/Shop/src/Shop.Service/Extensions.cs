using Shop.Service.Dtos;
using Shop.Service.Entities;

namespace Shop.Service
{
    public static class Extensions
    {
        public static ShopDto AsDto(this ShopDao item)
        {
            return new ShopDto(item.Id, item.AccountId, item.Name, item.EvaluationCount, item.StarRating, item.JoinDate, item.ProductCount, item.FollowerCount);
        }
    }
}