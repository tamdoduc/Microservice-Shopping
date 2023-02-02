const express = require("express");
const multer = require("multer");
const router = express.Router();

const Product = require("../Models/products");

const uploadMultipartForm = multer().none();

router.get("/", (req, res) => res.send("PRODUCT ROUTE"));

// @route POST api/products/create
// @desc Create product
// @access Public
router.post("/create", async (req, res) => {
  try {
    uploadMultipartForm(req, res, function (err) {
      const {
        accountId,
        nameProduct,
        imageURL,
        minPrice,
        maxPrice,
        countSold,
        countStar,
        discount,
      } = req.body;

      if (!accountId || !nameProduct || !imageURL || !minPrice || !maxPrice)
        return res
          .status(400)
          .json({ success: false, message: "Missing information" });

      const discountValue = Number(salePrice) - Number(price);
      const newProduct = new Product({
        accountId,
        nameProduct,
        imageURL,
        minPrice,
        maxPrice,
        countSold,
        countStar,
        discount,
      });

      //All good

      newProduct.save();
      res.json({
        success: true,
        message: "Product created successfully",
        productID: newProduct._id,
      });
    });
  } catch (error) {
    console.log(error);
    res.status(500).json({
      success: false,
      message: " Internal server error",
    });
  }
});

// @route GET api/products/all
// @desc Get All Product
// @access Public
router.get("/all", async (req, res) => {
  try {
    const products = await Product.find();
    res.json({ success: true, products });
  } catch (error) {
    console.log(error);
    res.status(500).json({
      success: false,
      message: " Internal server error",
    });
  }
});

// @route GET api/products/byAccountId
// @desc Get Product by accountId
// @access Public
router.get("/byAccountId", async (req, res) => {
  const accountId = req.query.accountId;
  try {
    console.log(accountId);
    const products = await Product.find({
      accountId,
    });
    res.json({ success: true, products });
  } catch (error) {
    console.log(error);
    res.status(500).json({
      success: false,
      message: " Internal server error",
    });
  }
});

// @route GET api/products/byProductId
// @desc Get Product by productId
// @access Public
router.get("/byProductId", async (req, res) => {
  const productId = req.query.productId;
  try {
    const product = await Product.findOne({
      _id: productId,
    });
    res.json({ success: true, product });
  } catch (error) {
    console.log(error);
    res.status(500).json({
      success: false,
      message: " Internal server error",
    });
  }
});

// @route Delete api/products/byProductId
// @desc delete 1 product
// @access Public
router.delete("/byProductId", async (req, res) => {
  const productId = req.query.productId;
  console.log("productId: ", productId);
  try {
    Product.findByIdAndDelete({ _id: productId });
  } catch (error) {
    console.log(error);
    res.status(500).json({
      success: false,
      message: " Internal server error",
    });
  }
});

// @route Delete api/products/byAccountId
// @desc delete all product by accountId
// @access Public
router.delete("/byAccountId", async (req, res) => {
  const { accountId } = req.body;
  try {
    await Product.deleteMany({ accountId: accountId });
    res.json({
      success: true,
      message: "Deleted Products accountId: " + accountId,
    });
  } catch (error) {
    console.log(error);
    res.status(500).json({
      success: false,
      message: " Internal server error",
    });
  }
});

// @route PUT api/products/update
// @desc update Product
// @access Public
router.put("/update", async (req, res) => {
  try {
    uploadMultipartForm(req, res, function (err) {
      const {
        accountId,
        nameProduct,
        imageURL,
        minPrice,
        maxPrice,
        countSold,
        countStar,
        discount,
      } = req.body;
      Product.findOneAndUpdate(
        { _id: productId },
        {
          accountId,
          nameProduct,
          imageURL,
          minPrice,
          maxPrice,
          countSold,
          countStar,
          discount,
        },
        { new: true },
        function (error, product) {
          console.log(product);
          if (!productt) {
            res.status(400).json({
              success: false,
              message: "product not found",
            });
          } else {
            res.status(200).json({
              success: true,
              message: " Updated product",
              product,
            });
          }
        }
      );
      // All Good
    });
  } catch (error) {
    console.log(error);
    res.status(500).json({
      success: false,
      message: " Internal server error",
    });
  }
});

// @route PUT api/products/upSoldCount
// @desc update
// @access Public
router.put("/upSoldCount", async (req, res) => {
  try {
    const { productId, count } = req.body;
    const oldProduct = await Product.findOne({ _id: productId });
    const newCount = oldProduct.countSold + count;
    Product.findOneAndUpdate(
      { _id: productId },
      {
        countSold: newCount,
      },
      { new: true },
      function (error, product) {
        console.log(product);
        if (!product) {
          res.status(400).json({
            success: false,
            message: "product not found",
          });
        } else {
          res.status(200).json({
            success: true,
            message: " Updated product",
            product,
          });
        }
      }
    );
    // All Good
  } catch (error) {
    console.log(error);
    res.status(500).json({
      success: false,
      message: " Internal server error",
    });
  }
});
