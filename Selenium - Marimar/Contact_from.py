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

contact_link = WebDriverWait(driver,10).until(
    EC.element_to_be_clickable((By.XPATH, "//a[@href='/marimar/index.php?p=contact']"))
)
contact_link.click()
print("click the contact link")
time.sleep(15)

form=driver.find_element(By.XPATH, "//form[@action='contact.php']")
print("found the contact form")
time.sleep(3)

name=form.find_element(By.NAME,"name")
name.send_keys("Test User")
print("entered the name")
time.sleep(2)

email=form.find_element(By.NAME,"email")
email.send_keys("tet1@gmail.com")
if "@"in email.get_attribute("value"):
        print("Email format is correct.")
else:
        print("Email format is incorrect.")

time.sleep(2)

sublect=form.find_element(By.NAME,"subject")
sublect.send_keys("Test Subject")
print("entered the subject")
time.sleep(2)

message=form.find_element(By.NAME,"message")
message.send_keys()

if message.get_attribute('value') == "This is a test message for contact form.":
        print("Message entered correctly.")
else:
        print("Message entry failed.")

time.sleep(2)

button=driver.find_element(By.XPATH, "//button[@class='contact_button']")
button.click()
print("click the send button")
time.sleep(10)


