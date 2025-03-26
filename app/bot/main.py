import time
import os
from datetime import datetime
import logging
from selenium import webdriver
import pandas as pd
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from authentication import authentication
from ColoredFormatter import ColoredFormatter

#configuração do logger
main_logger = logging.getLogger("MainLogger")
main_logger.setLevel(logging.INFO)
main_logger.handlers.clear()
main_logger.propagate = False
LOG_DIR = "../app/bot/log"
os.makedirs(LOG_DIR, exist_ok=True)
log_filename = os.path.join(LOG_DIR, datetime.now().strftime("%Y-%m-%d_%H-%M-%S.log"))
console_handler = logging.StreamHandler()
console_handler.setFormatter(ColoredFormatter('%(asctime)s - %(levelname)s - %(message)s'))
main_logger.addHandler(console_handler)
file_handler = logging.FileHandler(log_filename, encoding="utf-8")
file_handler.setFormatter(logging.Formatter('%(asctime)s - %(levelname)s - %(message)s'))
main_logger.addHandler(file_handler)


main_logger.info('\n***************✔ ROTINA INICIADA ✔***************\n')

def remover_espacos_extras(texto):
    """Remove espaços extras nos textos"""
    # O método split() divide a string em uma lista de palavras, ignorando espaços extras (inclusive quebras de linha, tabs, etc.)
    palavras = texto.split()
    # Junta as palavras com um único espaço
    return " ".join(palavras)


options = webdriver.ChromeOptions()
options.add_argument("--headless")
browser = webdriver.Chrome(service=Service(ChromeDriverManager().install()), options=options)
browser.get("https://outlook.office.com/mail/")
main_logger.info("Abrindo o outlook")

authentication(browser, main_logger)
wait = WebDriverWait(browser, 5)
button__people = wait.until(EC.visibility_of_element_located((By.XPATH, '//*[@id="355fbd79-3ba2-4554-8f2d-0300fde91f30"]')))
button__people.click()
BASE_DIR = os.path.dirname(os.path.abspath(__file__))  # Pega o diretório do script atual
RESOURCE_DIR = os.path.join(BASE_DIR, "resource")  # Caminho absoluto para a pasta resource
source = pd.read_excel(os.path.join(RESOURCE_DIR, "Planilha1.xlsx"))
if "Nome" in source.columns:
    nomes = source["Nome"].dropna()  # Remove valores vazios
else:
    print("Coluna 'Nome' não encontrada no arquivo!")

search = wait.until(EC.visibility_of_element_located((By.XPATH, '//*[@id="searchBoxColumnContainerId"]//input')))
main_logger.info("Iniciando pesquisas")
search.click()
for index, row in source.iterrows():
    colaborador = row["Nome"]
    dirty_text = colaborador
    clear_text = remover_espacos_extras(dirty_text)
    search.send_keys(clear_text)
    time.sleep(1) #não remover
    try:
        email = wait.until(EC.visibility_of_element_located((By.XPATH, '//*[@id="searchSuggestions"]//li[contains(@id, "HubPersonaId")]//div[contains(text(),"@")]')))
        email = email.text
        main_logger.info(f"✅ E-mail encontrado {email}")
        if "E-mail" not in source.columns:
            source["E-mail"] = ""
        source["E-mail"] = source["E-mail"].astype(str)
        source.at[index, "E-mail"] = email
    except Exception:
        main_logger.error(f"❌ Nenhum e-mail encontrado para {colaborador}")
        source.at[index, "E-mail"] = "Não encontrado"
    search.send_keys(Keys. CONTROL + "a")
    search.send_keys(Keys. DELETE)
# Salvar os dados atualizados em um novo arquivo Excel
BASE_DIR = os.path.dirname(os.path.abspath(__file__))  # Pega o diretório do script atual
RESOURCE_DIR = os.path.join(BASE_DIR, "result")  # Caminho absoluto para a pasta resource
source.to_excel(os.path.join(RESOURCE_DIR, "Planilha1_atualizada.xlsx"), index=False)
main_logger.info("Planilha salva com sucesso!")
time.sleep(2)
main_logger.info('\n*************** ROTINA FINALIZADA ***************\n')
browser.quit()

