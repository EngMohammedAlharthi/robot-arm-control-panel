```markdown
robot-arm-control-panel

A small PHP/MySQL app that lets you:
- save robot‑arm poses (6 motor sliders)
- view all poses in a table
- run a pose (status → Pending) via form
- remove a pose
- fetch the active pose as JSON (get_run_pose.php)
- reset pose status via API (update_status.php)

Files to upload:
- con.php             Database connection
- index.php           Main control panel UI + logic
- get_run_pose.php    API endpoint: GET active pose
- update_status.php   API endpoint: POST reset pose status
- README.md           This instructions file

Setup:
1. Create database `robot_arm` in phpMyAdmin
2. Run this SQL:
   CREATE TABLE poses (
     id INT AUTO_INCREMENT PRIMARY KEY,
     motor1 INT NOT NULL,
     motor2 INT NOT NULL,
     motor3 INT NOT NULL,
     motor4 INT NOT NULL,
     motor5 INT NOT NULL,
     motor6 INT NOT NULL,
     status TINYINT DEFAULT 0,
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
3. Copy all files into `htdocs/robot_arm/`
4. Start Apache & MySQL, browse to http://localhost/robot_arm/index.php

Usage:
- adjust sliders → Save Pose
- click Run/Remove in table
- GET http://localhost/robot_arm/get_run_pose.php
- POST id=… to http://localhost/robot_arm/update_status.php
```
