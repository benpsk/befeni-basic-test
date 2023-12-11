# befeni-basic-test

## Requirements
Ensure your system has Docker and Docker Compose installed with the following minimum versions:
- Docker: v24.0.2
- Docker Compose: v2.19.1

## Getting Started
1. **Build the project:**
    ```shell
    sudo docker compose build
    ```

2. **Run the project:**
    ```shell
    sudo docker compose up
    ```

3. **Access the app container shell:**
    ```shell
    sudo docker compose exec app bash
    ```

4. **Execute tests within the Docker container:**
    ```shell
    composer test
    ```

5. **Run `index.php` with a specified filename:**
    ```shell
    php index.php instructions.txt
    ```

## Notes
### Allowed Operations
- add, subtract, multiply, divide, apply

### Validation Rules
- Only files with a `.txt` extension are accepted.
- Maintain a single space between the operator and the value.
- Ensure the value is numeric.
- Verify the operator for validity.
- Avoid multiple `apply` operations in a single file.
- The `apply` operation must be the final operation.
