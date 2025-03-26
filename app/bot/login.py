import os
from pathlib import Path
from dotenv import load_dotenv

ENV_FILE = Path(__file__).resolve().parent/ '.env'
load_dotenv(
    dotenv_path=ENV_FILE, verbose=True, override=True, encoding='utf-8'
)
LOGINS = [
     {
        'user': os.getenv('user_outlook'),
        'pswd': os.getenv('password_outlook')
    },
]