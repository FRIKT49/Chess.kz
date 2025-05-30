function sendXMLRequest(url, method = 'GET', data = null) {
  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', url, true); // true = асинхронно
    console.log(true,url);
    
    xhr.onreadystatechange = function() {
        let request = JSON.parse(this.responseText)
        console.log(request);
        
    };

    xhr.onerror = () => reject('Сетевая ошибка');

    // Устанавливаем заголовки при необходимости
    
    xhr.send();

  });
}

async function findGame(url) {
  try {
    const response = await sendXMLRequest(url);
    console.log(response);
    // здесь выполняются действия только после получения ответа
  } catch (error) {
    console.error('Произошла ошибка:', error);
  }
}