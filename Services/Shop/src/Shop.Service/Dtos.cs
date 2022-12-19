using System;

namespace Shop.Service.Dtos
{
    public record ShopDto(Guid Id, Guid AccountId, string Name, int EvaluationCount, double StarRating, DateTime JoinDate, int ProductCount, int FollowerCount);
    public record CreateShopDto(Guid AccountId, string Name);
    public record UpdateShopDto(Guid Id, Guid AccountId, string Name, int EvaluationCount, double StarRating, DateTime JoinDate, int ProductCount, int FollowerCount);
}