// backend/server.js
require("dotenv").config();
console.log("✅ ENV loaded:", process.env.DB_USER); // <== add this

const express = require("express");
const pool = require("./db/database");
const userRoutes = require("./routes/userRoutes");

const app = express();
app.use(express.json());

// Route for checking DB connection
app.get("/test-db", async (req, res) => {
  try {
    const [rows] = await pool.query("SELECT 1 + 1 AS solution");
    res.json({ database: "working", result: rows[0].solution });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// Test root route
app.get("/", (req, res) => {
  res.send("🏨 Hotel API Ready!");
});

// Mount user routes
app.use("/api/users", userRoutes);

const PORT = process.env.PORT || 3000;

app.listen(PORT, () => {
  console.log(`🚀 Server running on http://localhost:${PORT}`);
});
