<?php
// db_create.php
// Seeder for Mood Tracker project
// WARNING: Drops and recreates tables

$servername = "jakubproject";
$username  = "root";
$password  = "";
$dbname    = "mood_db";
$port      = 3306;

$conn = new mysqli($servername, $username, $password, "", $port);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
$conn->set_charset('utf8mb4');

// Create database if missing
$conn->query("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci");
$conn->select_db($dbname);

// ---------------------------
// Disable FK checks before dropping
// ---------------------------
$conn->query("SET FOREIGN_KEY_CHECKS = 0");

// Drop tables
$tables = [
    'mood_entry_categories',
    'mood_entries',
    'mood_categories',
    'insights',
    'merch_orders',
    'merch',
    'merch_categories',
    'users'
];
foreach ($tables as $t) $conn->query("DROP TABLE IF EXISTS `$t`");

// Re-enable FK checks
$conn->query("SET FOREIGN_KEY_CHECKS = 1");

// ---------------------------
// Create tables
// ---------------------------

// USERS
$conn->query("
CREATE TABLE users (
  user_id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");

// MOOD CATEGORIES
$conn->query("
CREATE TABLE mood_categories (
  category_id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  description TEXT,
  PRIMARY KEY (category_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");

// MERCH CATEGORIES
$conn->query("
CREATE TABLE merch_categories (
  category_id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  PRIMARY KEY (category_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");

// MERCH
$conn->query("
CREATE TABLE merch (
  merch_id INT NOT NULL AUTO_INCREMENT,
  category_id INT NOT NULL,
  name VARCHAR(100) NOT NULL,
  price DECIMAL(8,2) NOT NULL,
  stock_quantity INT DEFAULT NULL,
  description TEXT,
  PRIMARY KEY (merch_id),
  KEY merch_categories_fk (category_id),
  CONSTRAINT fk_merch_category FOREIGN KEY (category_id) REFERENCES merch_categories(category_id) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");

// MOOD ENTRIES
$conn->query("
CREATE TABLE mood_entries (
  entry_id INT NOT NULL AUTO_INCREMENT,
  user_id INT NOT NULL,
  intensity TINYINT DEFAULT NULL,
  notes TEXT,
  hours_of_sleep INT DEFAULT NULL,
  entry_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (entry_id),
  KEY users_moodentries_fk (user_id),
  CONSTRAINT fk_mood_entries_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");

// MOOD ENTRY CATEGORIES
$conn->query("
CREATE TABLE mood_entry_categories (
  link_id INT NOT NULL AUTO_INCREMENT,
  entry_id INT NOT NULL,
  category_id INT NOT NULL,
  PRIMARY KEY (link_id),
  KEY mec_mc_fk (category_id),
  KEY moodentries_mec_fk (entry_id),
  CONSTRAINT fk_mec_entry FOREIGN KEY (entry_id) REFERENCES mood_entries(entry_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_mec_category FOREIGN KEY (category_id) REFERENCES mood_categories(category_id) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");

// INSIGHTS
$conn->query("
CREATE TABLE insights (
  insight_id INT NOT NULL AUTO_INCREMENT,
  user_id INT NOT NULL,
  insight_text TEXT NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (insight_id),
  KEY users_insights_fk (user_id),
  CONSTRAINT fk_insights_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");

// MERCH ORDERS
$conn->query("
CREATE TABLE merch_orders (
  merch_order_id INT NOT NULL AUTO_INCREMENT,
  user_id INT NOT NULL,
  merch_id INT NOT NULL,
  quantity INT DEFAULT 1,
  total_price DECIMAL(8,2) NOT NULL,
  order_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (merch_order_id),
  KEY merch_fk (merch_id),
  KEY users_fk (user_id),
  CONSTRAINT fk_merchorder_merch FOREIGN KEY (merch_id) REFERENCES merch(merch_id) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT fk_merchorder_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");

// ---------------------------
// Insert mock data
// ---------------------------

// USERS
$stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, created_at) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $username, $email, $password_hash, $created_at);

$users = [
    ['jakub','g00424689@atu.ie', password_hash('test', PASSWORD_DEFAULT), date('Y-m-d H:i:s')],
    ['alice','alice@example.com', password_hash('alice123', PASSWORD_DEFAULT), date('Y-m-d H:i:s')],
    ['bob','bob@example.com', password_hash('bob123', PASSWORD_DEFAULT), date('Y-m-d H:i:s')],
    ['charlie','charlie@example.com', password_hash('charlie123', PASSWORD_DEFAULT), date('Y-m-d H:i:s')],
    ['diana','diana@example.com', password_hash('diana123', PASSWORD_DEFAULT), date('Y-m-d H:i:s')]
];

foreach ($users as $u) {
    [$username,$email,$password_hash,$created_at] = $u;
    $stmt->execute();
}
$stmt->close();

// MOOD CATEGORIES
$stmt = $conn->prepare("INSERT INTO mood_categories (name, description) VALUES (?, ?)");
$stmt->bind_param("ss", $cat_name, $cat_desc);
$categories = [
    ['Very Happy','Feeling ecstatic, joyful, or delighted'],
    ['Happy','Feeling good and positive'],
    ['Neutral','Neither positive nor negative'],
    ['Sad','Feeling down or upset'],
    ['Very Sad','Feeling deeply sad or hopeless']
];

$moodCategoryIDs = [];
foreach ($categories as $c) {
    [$cat_name,$cat_desc] = $c;
    $stmt->execute();
    $moodCategoryIDs[] = $conn->insert_id; // store actual inserted ID
}
$stmt->close();

// MERCH CATEGORIES
$stmt = $conn->prepare("INSERT INTO merch_categories (name) VALUES (?)");
$stmt->bind_param("s", $cat_name);
$merch_cats = ['Stress Relief','Journals & Planners','Mugs & Accessories'];
foreach ($merch_cats as $cat_name) $stmt->execute();
$stmt->close();

// MERCH
$stmt = $conn->prepare("INSERT INTO merch (category_id, name, price, stock_quantity, description) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("isdss", $cid, $mname, $mprice, $mstock, $mdesc);
$merch_items = [
    [1,'Stress Ball',9.99,50,'Squeeze away anxiety.'],
    [2,'Mood Journal',14.50,30,'Daily prompts to reflect on mood.'],
    [3,'Motivational Mug',12.00,40,'Start your day with a smile.']
];
foreach ($merch_items as $mi) [$cid,$mname,$mprice,$mstock,$mdesc] = $mi; $stmt->execute();
$stmt->close();

// MOOD ENTRIES (~20)
$stmt = $conn->prepare("INSERT INTO mood_entries (user_id, intensity, notes, hours_of_sleep, entry_date) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iisis", $user_id, $intensity, $notes, $hours_of_sleep, $entry_date);
$notesArr = [
    "Had a great day at work, productive and fun.",
    "Felt a bit tired, but overall okay.",
    "Stressful day, arguments at work.",
    "Good run in the morning, stayed active.",
    "Did not sleep well, felt anxious.",
    "Enjoyed weekend with friends.",
    "Mediocre day, nothing special.",
    "A bit down today, missing home.",
    "Got great feedback on a project!",
    "Really rough day emotionally.",
    "Still feeling low but improving.",
    "Met up with friends, relaxed evening.",
    "Had a good productive day at work.",
    "Average day, watched a movie.",
    "Didn’t sleep well and it affected my mood.",
    "Finally feeling optimistic again.",
    "Relaxing weekend, read a good book.",
    "Had anxiety before presentation.",
    "Excited about upcoming trip!",
    "Feeling neutral overall."
];
for ($i=0;$i<20;$i++){
    $user_id = ($i%5)+1; // distribute among users 1..5
    $intensity = rand(1,10);
    $notes = $notesArr[$i];
    $hours_of_sleep = rand(4,9);
    $entry_date = date('Y-m-d H:i:s', strtotime("-$i days"));
    $stmt->execute();
}
$stmt->close();

// MOOD ENTRY CATEGORIES
$stmt = $conn->prepare("INSERT INTO mood_entry_categories (entry_id, category_id) VALUES (?, ?)");
$stmt->bind_param("ii", $entry_id, $category_id);
for ($entry_id=1;$entry_id<=20;$entry_id++){
    $category_id = $moodCategoryIDs[($entry_id-1)%count($moodCategoryIDs)];
    $stmt->execute();
}
$stmt->close();

// INSIGHTS
$stmt = $conn->prepare("INSERT INTO insights (user_id, insight_text, created_at) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $user_id, $insight_text, $created_at);
$insights = [
    [1,'Regular journaling helps improve mood awareness.'],
    [2,'Exercise seems to boost my happiness.'],
    [3,'Socializing reduces my anxiety.'],
    [4,'Listening to music helps me relax.'],
    [5,'Meditation improved my concentration.']
];
foreach ($insights as $ins) {
    [$user_id,$insight_text] = $ins;
    $created_at = date('Y-m-d H:i:s');
    $stmt->execute();
}
$stmt->close();

echo "Database created, tables inserted with mock data successfully.";
$conn->close();
?>
