const express = require("express");
const cors = require("cors");

const app = express();
const PORT = 5001; // Try different port

// Middleware
app.use(cors());
app.use(express.json());

// Test route
app.get("/", (req, res) => {
  res.send("API is working");
});

app.post("/api/users", (req, res) => {
  console.log(req.body);
  res.json({ message: "User received", user: req.body });
});

// Start server
app.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});
