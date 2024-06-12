var getButton = document.getElementById('getButton');
function get_ID() {
  return new Promise(function (resolve, reject) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'getID.php', true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          var response = xhr.responseText;
          // alert(response);
          resolve(response);
        } else {
          reject(new Error('Помилка отримання ID'));
        }
      }
    };
    xhr.send();
  });
}

async function doSomething() {
  try {
    var ID = await get_ID();
    console.log(ID);
    console.log(ID == "-1");
    if (ID != -"1") {
      var element = document.getElementById("log_in");
      element.innerText = "Office";
      element.href = "View/office.html"
      element.style.cursor = "pointer";
    }
    // Тут ви можете використовувати отримане значення ID
  } catch (error) {
    console.error(error);
  }
}
function get_codes(file) {
    mass = []
    names = []
    descriptions = []
    var xhr = new XMLHttpRequest();
    xhr.open('GET', file, true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          var text = xhr.responseText;
          console.log(text)
          if (xhr.responseText == "Немає результатів для вказаного значення") {
            document.getElementById("more").style.display = "none";
            return;
          }
          i = 1;
          while (text.length > 0) {
            console.log(text)
            var nameIndex = text.indexOf('code_name:') + 10;
            if (nameIndex == -1) {
              break;
            }
            // Виділяємо окремі складові
            var codeId = text.substring(text.indexOf('code_id:') + 8, nameIndex - 10).trim();
            console.log(codeId)
            var codeName = text.substring(nameIndex, text.indexOf('code_description:')).trim();
            names[codeId - 1] = codeName
            console.log(codeName)
            //text = text.substring(nameIndex - 3);
            var descriptionIndex = text.indexOf('code_description:');
            console.log(text.indexOf('\n'))
            var codeDescription = text.substring(descriptionIndex + 17, text.indexOf('\n'));
            descriptions[codeId - 1] = codeDescription;
            console.log("codeDescription " + codeDescription)
            console.log(text.indexOf('code_description:'))
            text = text.substring(descriptionIndex + 18 + codeDescription.length);
            // alert('codeId:* ' + codeId);
            //alert('code_name:* ' + codeName);
            //alert('code_description:* ' + codeDescription);
            var html = `
            <div class="u-size-20 u-size-30-md">
            <div class="u-layout-col">
              <div class="u-container-style u-layout-cell u-left-cell u-palette-1-base u-size-30 u-layout-cell-1">
                <div class="u-container-layout u-container-layout-1"><span class="u-file-icon u-icon u-icon-1"><img
                      src="images/${codeId}.png" alt=""></span>
        <h4 class="u-text u-text-body-alt-color u-text-default u-text-3">${codeName}</h4>
        <p class="u-text u-text-body-alt-color u-text-default u-text-4">${codeDescription}</p>
        <a href="Страница-1.html?id=${codeId}" class="u-active-none u-btn u-button-style u-hover-none u-none u-text-body-alt-color u-text-hover-palette-3-light-2 u-btn-2">See code<span class="u-icon"><svg class="u-svg-content" viewBox="0 0 492.004 492.004" x="0px" y="0px" id="svg-414b" style="width: 1em; height: 1em;"><!-- Решта SVG-коду... --></svg></span></a>
      </div>
    </div>
    <div class="u-container-style u-layout-cell u-size-20 u-layout-cell-5">
      <div class="u-container-layout u-container-layout-5"></div>
    </div>
  </div>
</div>
`;

            // Отримати посилання на елемент <div class="u-gutter-0 u-layout">
            var container = document.querySelector('.u-gutter-0.u-layout');
            // Додати створений HTML до елементу <div class="u-gutter-0 u-layout">
            container.innerHTML += html;
            mass[codeId - 1] = codeId

            i++;
          }
        } else {
          reject(new Error('Помилка отримання ID'));
        }
      }
    };
    xhr.send();
  }
  function getLastCodes(file) {
    mass = []
    names = []
    descriptions = []
    var xhr = new XMLHttpRequest();
    xhr.open('GET', file, true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          var text = xhr.responseText;
          console.log(text)
          i = 1;
          while (text.length > 0) {
            console.log(text)
            var nameIndex = text.indexOf('code_name:') + 10;
            if (nameIndex == -1) {
              break;
            }
            // Виділяємо окремі складові
            var codeId = text.substring(text.indexOf('code_id:') + 8, nameIndex - 10).trim();
            console.log("last " + codeId)
            var codeName = text.substring(nameIndex, text.indexOf('code_description:')).trim();
            names[codeId - 1] = codeName
            console.log(codeName)
            //text = text.substring(nameIndex - 3);
            var descriptionIndex = text.indexOf('code_description:');
            console.log(text.indexOf('\n'))
            var codeDescription = text.substring(descriptionIndex + 17, text.indexOf('\n'));
            descriptions[codeId - 1] = codeDescription;
            console.log("codeDescription " + codeDescription)
            console.log(text.indexOf('code_description:'))
            text = text.substring(descriptionIndex + 18 + codeDescription.length);
            // alert('codeId:* ' + codeId);
            //alert('code_name:* ' + codeName);
            //alert('code_description:* ' + codeDescription);
            mass[codeId - 1] = codeId
            i++;
          }

          var lastThreeNames = names.slice(-3); // Extract the last three names
          var lastThreeDescriptions = descriptions.slice(-3); // Extract the last three descriptions
          var lastThreeMass = mass.slice(-3); // Extract the last three mass values



          // Loop through the last three entries and add the name to the text
          for (var i = 0; i < lastThreeNames.length; i++) {
            if (i == 0) {
              var textElement = document.getElementById("new1"); // Get the text element with id "new1"
              var pElement = document.getElementById("p1"); // Get the text element with id "p1"
              var aElement = document.getElementById("a1"); // Get the text element with id "a1"
              var imgElement = document.getElementById("img1"); // Get the text element with id "img1"
            }
            if (i == 1) {
              var textElement = document.getElementById("new2"); // Get the text element with id "new1"
              var pElement = document.getElementById("p2");
              var aElement = document.getElementById("a2");
              var imgElement = document.getElementById("img2");
            }
            if (i == 2) {
              var textElement = document.getElementById("new3"); // Get the text element with id "new1"
              var pElement = document.getElementById("p3");
              var aElement = document.getElementById("a3");
              var imgElement = document.getElementById("img3");
            }
            var name = lastThreeNames[i];
            var description = lastThreeDescriptions[i];
            // var massValue = lastThreeMass[i];

            // var newText = "Name: " + name + ", Description: " + description + ", Mass: " + massValue;

            // Append the new text to the existing text content
            textElement.textContent = name;
            pElement.innerText = description;
            aElement.href = href = `View/Страница-1.html?id=${names.length - 2 + i}`;
            imgElement.src = `images/${names.length - 2 + i}.png`
          }
        } else {
          reject(new Error('Помилка отримання ID'));
        }
      }
    };
    xhr.send();

  }
doSomething();
