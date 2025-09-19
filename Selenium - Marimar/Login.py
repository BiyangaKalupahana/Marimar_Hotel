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


login_button = WebDriverWait(driver, 10).until(
    EC.element_to_be_clickable((By.XPATH, "//a[@title='Login Guest']"))
)
login_button.click()
print("click the login button")
time.sleep(10)

username_field=WebDriverWait(driver, 10).until(
    EC.presence_of_element_located((By.ID,"U_USERNAME"))
)
print("found the username field")
print("You have 15 seconds to type the username manually in the browser...")
time.sleep(15) 

passwor_field=WebDriverWait(driver,10).until(
    EC.presence_of_element_located((By.ID,"U_PASS"))
)
print("found the password field")
print("You have 15 seconds to type the password manually in the browser...")
time.sleep(15)

time.sleep(7)
submit_button=WebDriverWait(driver,10).until(
    EC.element_to_be_clickable((By.NAME,"btnLogin"))
)
submit_button.click()
print("click the submit button to login")
time.sleep(10)