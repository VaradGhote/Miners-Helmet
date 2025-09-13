import mysql.connector 
from mysql.connector import Error

try:
    # Correct the typo in the parameter name 'databas' to 'database'
    conn = mysql.connector.connect(host='localhost', database='EDI', user='root', password='')

    if conn.is_connected():
        db = conn.get_server_info()
        print("Connected to database:", db)
        cursor = conn.cursor()
        create_table_query = '''
        CREATE TABLE employees (
            employee_id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(50) NOT NULL,
            last_name VARCHAR(50) NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL,
            hire_date DATE NOT NULL,
            job_title VARCHAR(50) NOT NULL,
            salary DECIMAL(10, 2) NOT NULL,
            department_id INT
        );
        '''
        cursor.execute(create_table_query)
        conn.commit()
        print("Table 'employees' created successfully.")


except Error as e:
    # Include the exception details in the error message
    print("Error while connecting to database:", e)

finally:
    if conn.is_connected():
        conn.close()
        print("Connection closed.")
