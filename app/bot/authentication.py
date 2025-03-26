import time
import logging
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from ColoredFormatter import ColoredFormatter
from login import LOGINS

def authentication(browser, logger):
    """ Rotina de abrir o outlook e realizar login com as 
        credenciais fornecidas no arquivo .env"""
    logger.info("🚀 Iniciando autenticação do outlook")
    # time.sleep(3)
    wait = WebDriverWait(browser, 5)
    user = wait.until(EC.visibility_of_element_located((By.XPATH, '//*[@id="i0116"]'))) #Campo de usuário
    user.click()
    user.send_keys(LOGINS[0]['user'])
    button = wait.until(EC.element_to_be_clickable((By.XPATH,'//*[@id="idSIButton9"]'))) #1° botão avançar
    button.click()
    # time.sleep(3)
    password = wait.until(EC.visibility_of_element_located((By.XPATH, '//*[@id="i0118"]')))#Campo de senha
    password.click()
    password.send_keys(LOGINS[0]['pswd'])
    button2 = wait.until(EC.element_to_be_clickable((By.XPATH,'//*[@id="idSIButton9"]')))#2° botão avançar
    button2.click()
    # time.sleep(3)
    button__again = wait.until(EC.element_to_be_clickable((By.XPATH,'//*[@id="KmsiCheckboxField"]')))#Botão "Não mostrar novamente"
    button__again.click()
    button__no = wait.until(EC.element_to_be_clickable((By.XPATH,'//*[@id="idBtn_Back"]')))#Botão "NÃO"
    button__no.click()
    # time.sleep(3)