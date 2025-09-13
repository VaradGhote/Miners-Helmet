import serial
import mysql.connector 
from mysql.connector import Error
from decimal import Decimal
import datetime

ser = serial.Serial(port='COM10',baudrate=115200)


try:
    # Correct the typo in the parameter name 'databas' to 'database'
    conn = mysql.connector.connect(host='localhost', database='EDI', user='root', password='')
    cursor = conn.cursor()

    if conn.is_connected():
            db = conn.get_server_info()
            x = 1
            ID=5
            print("Connected to database:", db)
            cursor = conn.cursor()
            while x == 1:
                value=ser.readline()
                valueInString = str(value,'UTF-8')
                if valueInString.startswith('f'):
                    # Perform specific action if needed, currently just passing
                    if ID != 5:
                        new_value = 0  # Example new value for the entry
                        update_query = "UPDATE employee SET Active_Status = %s WHERE ID = %s"
                        update_values = (new_value, ID)
                        cursor.execute(update_query, update_values)
                        conn.commit()
                else:
                    data_list = valueInString.split('!')       
                    humid = Decimal(data_list[1])
                    temp = Decimal(data_list[2])
                    gas = Decimal(data_list[3])
                    ID = int(data_list[4])
                    name = str(data_list[5])
                    current_time = datetime.datetime.now()
                    formatted_time = current_time.strftime("%H:%M:%S")

            
                    print(f"gas: {gas}")
                    print(f"temp: {temp}")
                    print(f"humid: {humid}")
                    print(f"ID: {ID}")
                    
                    query = "SELECT Buzzer_Status FROM employee WHERE ID = %s"
                    cursor.execute(query, (ID,))
                    res = cursor.fetchone()

                    if res:
                        ser.write(bytes(str(res[0]), 'utf-8'))
                        print(f"Buzzer Status: {res[0]}")
                        new_value = 0  # Example new value for the entry
                        update_query = "UPDATE employee SET Buzzer_Status = %s WHERE ID = %s"
                        update_values = (new_value, ID)
                        cursor.execute(update_query, update_values)
                        conn.commit()
                    table_name = f"emp_{ID}"
                    new_value = 1  # Example new value for the entry
                    update_query = "UPDATE employee SET Active_Status = %s WHERE ID = %s"
                    update_values = (new_value, ID)
                    cursor.execute(update_query, update_values)
                    conn.commit()
                    
                    cursor.execute("SELECT ID FROM employee WHERE ID = %s", (ID,))

                    result = cursor.fetchone()
                    
                    
                    if result:
                        linked_bd = result[0]
                        cursor.execute(f"SELECT MAX(srno) FROM {table_name}")
                        max_srno = cursor.fetchone()[0]
                        srno = max_srno + 1 if max_srno else 1
                        
                        employee_entry_query = f"INSERT INTO {table_name} (`srno`, `Humid`, `temp`, `gas`,`time`) VALUES (%s, %s, %s, %s,%s)"
                        employee_entry_values = (srno,humid,temp,gas,formatted_time)
                        cursor.execute(employee_entry_query, employee_entry_values)
                        conn.commit()
                    else:
                        print(f"Linked DB:ffff")
                        
                        
                        
                        create_table_query = f'''
                        CREATE TABLE {table_name} (
                        srno INT,
                        Humid DECIMAL(10, 2),
                        temp DECIMAL(10, 2),
                        gas DECIMAL(10, 2),
                        time VARCHAR(10)
                        ) ;                         
                        '''
                        cursor.execute(create_table_query)
                        conn.commit()
                        
                        # cursor.execute(f"SELECT MAX(Sr.no) FROM employee")
                        # max_sr = cursor.fetchone()[0]
                        # sr = max_sr + 1 if max_sr else 1
                        
                        employee_entry_query = "INSERT INTO Employee (`Name`, `ID`, `Active_Status`, `Buzzer_Status`, `linked_DB`) VALUES (%s, %s, %s, %s, %s)"
                        employee_entry_values = (name, ID, 0, 0, table_name)
                        cursor.execute(employee_entry_query, employee_entry_values)
                        conn.commit()
                        
                        employee_entry_query = f"INSERT INTO {table_name} (`srno`, `Humid`, `temp`, `gas`, `time`) VALUES (%s, %s, %s, %s,%s)"
                        employee_entry_values = (1,humid,temp,gas,formatted_time)
                        cursor.execute(employee_entry_query, employee_entry_values)
                        conn.commit()
                
                        
                # cursor.execute("SELECT * FROM employee")
                # final = cursor.fetchone()
                # same =len(final)
                # print(same)
                
                    
                

                
                # current_time = datetime.datetime.now()
                # time2 = current_time + datetime.timedelta(hours=1, minutes=45)
                # time_difference = time2 - current_time

                # difference_in_minutes = time_difference.total_seconds() / 60
                
                # if  difference_in_minutes > 1 :
                          
                        
                        
               
        
except Error as e:
    # Include the exception details in the error message
    print("Error while connecting to database:", e)

finally:
    if conn.is_connected():
        conn.close()
        print("Connection closed.")