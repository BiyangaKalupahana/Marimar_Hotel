from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.chrome.service import Service
import time

#Room search and booking automation script

#create service with path to chromedriver
service=Service(ChromeDriverManager().install())

driver = webdriver.Chrome(service=service)


driver.get("http://localhost/marimar/")
print("sucessfully opened the websites")

input("After filling details and press enter to continue...")
print("finished filling details and after click the book now button")
time.sleep(5)


try:
    book_button = WebDriverWait(driver, 10).until(
        EC.element_to_be_clickable((By.CLASS_NAME, "booking_form_button"))
    )
    book_button.click()
    print("Clicked on the 'Book Now' button successfully.")

except Exception as e:
    print(f"Error: The button could not be clicked. The element might not be available. Details: {e}")


#keep open browser seconds 15
time.sleep(15)


book1_buttom= WebDriverWait(driver, 10).until(
    EC.element_to_be_clickable((By.ID,"booknow"))
)

book1_buttom.click()
print("click the book button to selected room")

time.sleep(15)

try:
    
    continue_button = WebDriverWait(driver, 10).until(
        EC.element_to_be_clickable((By.XPATH, "//a[contains(text(), 'Continue Booking')]"))
    )
    continue_button.click()
    print("Clicked on the 'Continue Booking' button successfully.")

   
   

except Exception as e:
    print(f"Error: The 'Continue Booking' link could not be clicked. Details: {e}")

time.sleep(15)


#user register and fill the personal details form

register_link = driver.find_element(By.XPATH, "//a[contains(text(), 'Register')]")
register_link.click()

time.sleep(5)
form=driver.find_element(By.NAME,"personal")
print("open the personal details form")
time.sleep(2)

first_name = form.find_element(By.ID, "name")
first_name.clear()
first_name.send_keys("prabash")
print("enter the first name")
time.sleep(2)

last_name = form.find_element(By.ID, "last")
last_name.clear()
last_name.send_keys("lakshitha")
print("enter the last name")
time.sleep(2)

city = form.find_element(By.ID, "city")
city.clear()
city.send_keys("colombo")
print("enter the city")
time.sleep(2)

address = form.find_element(By.ID, "address")
address.clear()
address.send_keys("212/a,kolonnawa,colombo 15")
print("enter the address")
time.sleep(2)

driver.execute_script("document.getElementById('dbirth').value = '2000-01-01'")
print("enter the date of birth")
time.sleep(2)

num = form.find_element(By.ID, "phone")
num.clear()
num.send_keys("0772087845")
print("enter the number")
time.sleep(2)

nationality = form.find_element(By.ID, "nationality")
nationality.clear()
nationality.send_keys("sri lankan")
print("enter the nationality")
time.sleep(2)

company = form.find_element(By.ID, "company")
company.clear()
company.send_keys("GMC PVT LTD")
print("enter the company")
time.sleep(2)

caddress = form.find_element(By.ID, "caddress")
caddress.clear()
caddress.send_keys("12/a,kolonnawa,colombo 15")
print("enter the company address")
time.sleep(2)

cemail = form.find_element(By.ID, "cemail")
cemail.clear()
cemail.send_keys("GMC35@gmail.com")

if '@' not in cemail.get_attribute('value'):
    print("Error: The entered email address is not valid. It must contain the '@' symbol.")
    driver.close()
    raise ValueError("Invalid email address")
print("enter the company mail")
time.sleep(2)

element = form.find_element(By.ID, "username")
driver.execute_script("arguments[0].scrollIntoView(true);", element)
element.send_keys("prabash123")
print("enter the username")
time.sleep(2)

password = form.find_element(By.ID, "password")
password.clear()
password.send_keys("Prabash@123")
print("enter the password")
time.sleep(2)

zip = form.find_element(By.ID, "zip")
zip.clear()
zip.send_keys("110856")
print("enter the zip")
time.sleep(2)

checkbox = form.find_element(By.NAME, "condition")
checkbox.click()



if not checkbox.is_selected():
    print("want agree the term and condition")
    driver.close()
    raise Exception("The terms and conditions checkbox was not selected.")
print("click the checkbox")
time.sleep(2)

confirm_button = form.find_element(By.NAME, "submit")
confirm_button.click()
print("click the confirm button")

