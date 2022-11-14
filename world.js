window.onload = function() {

    const  input = document.getElementById('country');
    const  lookUp = document.getElementById('lookup');
    const  cities = document.getElementById("cities");
    const  result = document.getElementById('result');
    const  httpReq= new XMLHttpRequest();
     
    const display=(url)=>{
      httpReq.onreadystatechange = mustcallback;
      httpReq.open('GET', url);
      httpReq.send();
    }
  
      lookUp.addEventListener('click', function(e) {
      e.preventDefault();
      const search = input.value;
      const  url = `world.php?country=${search.trim()}`;
      display(url);
    });
  
      cities.addEventListener('click', function(e) {
      e.preventDefault();
      const search = input.value;
      const  url = `world.php?country=${search.trim()}&context=${search.trim()}`;
      display(url);
    });
  
    
    
    const mustcallback=()=> {
      input.value = '';
      if (httpReq.readyState === XMLHttpRequest.DONE) {
        if (httpReq.status === 200) {
          result.innerHTML=httpReq.responseText;
        } else {
          alert('Can not process this requst.');
        }
      }
    }
  
  }