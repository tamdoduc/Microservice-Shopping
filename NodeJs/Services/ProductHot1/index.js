require("dotenv").config();
const express = require("express");
const mongoose = require("mongoose");
const cors = require("cors");
const amqp = require("amqplib");

const productRouter = require("./routes/product");

const connectDB = async () => {
  try {
    await mongoose.connect(
      `mongodb+srv://turtle19520253:19520253@cluster0.spkv5qe.mongodb.net/?retryWrites=true&w=majority`
    );
    console.log("MongoDB connected");
  } catch (error) {
    console.log(error.message);
    process.exit(1);
  }
};

connect();
async function connect() {
  try {
    const connection = amqp.connect("amqp://localhost:5672");
    const channel = await (await connection).createChannel();

    let queueName = "jobs";
    const result = await channel.assertQueue("jobs");
    await channel.consume(queueName, (msg) => {
      console.log(`Received: ${msg.content.toString()}`);
      console.log("Sorting...........................................");
      channel.ack(msg);
    });
  } catch (ex) {
    console.error(ex);
  }
}

connectDB();

const app = express();

app.use(cors({ origin: "*" }));

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

app.use("/api/products", productRouter);
const PORT = 5005;

app.listen(PORT, () => console.log(`Server started on port ${PORT}`));
app.get("/", (req, res) => res.send("PRODUCT Hot"));
module.exports = app;
