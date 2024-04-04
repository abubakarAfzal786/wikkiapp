### Article Edits Table:

| Column Name   | Data Type | Description                            |
|---------------|-----------|----------------------------------------|
| edit_id       | integer   | Unique identifier for each edit        |
| article_id    | integer   | ID of the article being edited         |
| ip_address    | varchar   | IP address of the editor               |
| edit_timestamp| timestamp | Timestamp of the edit                  |

**Indexes:**
- Primary key index on `edit_id`.
- Index on `article_id`.
- Index on `ip_address`.

### IP Address Range Table:

| Column Name | Data Type | Description                               |
|-------------|-----------|-------------------------------------------|
| ip_range_id | integer   | Unique identifier for each IP range       |
| start_ip    | varchar   | Starting IP address of the IP range       |
| end_ip      | varchar   | Ending IP address of the IP range         |

**Indexes:**
- Primary key index on `ip_range_id`.
- Composite index on (`start_ip`, `end_ip`).
