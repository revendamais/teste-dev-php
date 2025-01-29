import { reactive } from 'vue';

interface AlertState {
  show: boolean;
  message: string;
  backgroundColor: string;
  textColor: string;
}

const alert = reactive<AlertState>({
  show: false,
  message: '',
  backgroundColor: '',
  textColor: ''
});

const setAlert = (message: string, backgroundColor: string, textColor: string) => {
  resetAlert(); // Redefinir o estado atual

  setTimeout(() => {
    // Exibir o alerta com os novos valores
    alert.show = true;
    alert.message = message;
    alert.backgroundColor = backgroundColor;
    alert.textColor = textColor;
  }, 10); // Delay para Vue detectar a mudança
};

const resetAlert = () => {
  alert.show = false;
  alert.message = '';
  alert.backgroundColor = '';
  alert.textColor = '';
};

export { alert, setAlert, resetAlert };
