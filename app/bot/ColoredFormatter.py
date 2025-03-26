import logging
from termcolor import colored

# Define um formato de log com cores e outros parâmetros de formatação
class ColoredFormatter(logging.Formatter):
    def format(self, record):
        log_colors = {
            'DEBUG': ['blue'],
            'INFO': ['green'],
            'WARNING': ['yellow'],
            'ERROR': ['red'],
            'CRITICAL': ['red', 'on_white']
        }
        log_attrs = {
            'CRITICAL': ['bold']
        }
        log_color = log_colors.get(record.levelname, ['white'])
        attrs = log_attrs.get(record.levelname, [])
        record.msg = colored(record.msg, *log_color, attrs=attrs)
        return super().format(record)