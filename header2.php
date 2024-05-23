<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="globals.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="header">
    <div class="div">
      <div class="div-header-search">
        <div class="form-wrapper">
          <div class="form">
            <div class="div-div-input">
              <div class="p-div-input-text"><input type="text" id="searchbar" class="text-wrapper" style="all:unset;text-align: start;" placeholder="White Dress"></div>
            </div>
            <img class="div-search-btn" src="img/div-search-btn.svg" />
          </div>
        </div>
      </div>
      <?php
      if ($username == "0") {

        echo "<div class='div-header-right'>
                    <div class='link'>
                        <div class='text-wrapper-1'><a href='Signup.php'>Sign In</a></div>
                    </div>
                    <div class='div-navbar-link'></div>
                    <div class='div-wrapper'>
                        <div class='text-wrapper-1'><a href='Login.php'>Log In</a></div>
                    </div>
                </div>";
      } else {
        echo " <div class='div-header-right' >
        <img class='profile' onclick='showSettingsPopup()' src='img/profile.svg' />
        <div class='cart'>
          <a href='cart.php'> <img class='vector' src='img/vector.svg' /></a>
          <div class='text-wrapper-2'>$cartcount</div>
        </div>
      ";
        if ($verification != 1) {
          echo "<script> alert('Please Verify your account first');window.location.href = 'mail.php';</script>";
        }
        echo "</div>";
      }
      ?>

      <a href="Landing page.php">
        <div class="heading">
          <div class="logo-png"><img src="<?= $logo ?>" width="50"></div>
          <div class="text-wrapper">
            <?= $companyname ?>
          </div>
        </div>
      </a>
      <div class="output" style="display: none;">
        <div id="demo">
        </div>
      </div>
    </div>

  </div>

</body>
<?php include 'popups.php'; ?>
<script>
  function openPopup(popupId) {
    // Close any open popups and overlay with fade-out effect
    var openElements = document.querySelectorAll(' .popup, .popup-overlay');
    openElements.forEach(function(element) {
      element.style.opacity = 0;
      setTimeout(function() {
        element.style.display = 'none';
      }, 150);
    }); // Open the selected popup and overlay with fade -in effect 
    var overlay = document.querySelector('.popup-overlay');
    var
      popup = document.getElementById(popupId);
    setTimeout(function() {
        overlay.style.display = 'block';
        popup.style.display = 'block';
        setTimeout(function() {
          overlay.style.opacity = 1;
          popup.style.opacity = 1;
        }, 10);
      },
      150);
  }

  function closePopup(popupId) { // Close the popup and overlay with fade-out effect var
    elementsToClose = document.querySelectorAll('.popup, .popup-overlay');
    elementsToClose.forEach(function(element) {
      element.style.opacity = 0;
      setTimeout(function() {
        element.style.display = 'none';
      }, 300);
    });
  }
  document.addEventListener('DOMContentLoaded', function() {
    var loginBtn = document.querySelector('.loginb');
    var
      signupBtn = document.querySelector('.signupb');
    var sloginBtn = document.querySelector('.sloginb');
    var
      ssignupBtn = document.querySelector('.ssignupb');
    loginBtn.addEventListener('click', function() {
      openPopup('LoginPopup');
    });
    signupBtn.addEventListener('click', function() {
      openPopup('SignupPopup');
    });
    sloginBtn.addEventListener('click', function() {
      openPopup('LoginPopup');
    });
    ssignupBtn.addEventListener('click',
      function() {
        openPopup('SignupPopup');
      });
  });

  function closeLoginPopup() {
    document.getElementById('LoginPopup').style.display = 'none';
    var overlay = document.querySelector('.popup-overlay');
    overlay.style.opacity = 0;
    setTimeout(function() {
      overlay.style.display = 'none';
    }, 300);
  }

  function
  closeSignupPopup() {
    document.getElementById('SignupPopup').style.display = 'none';
    var
      overlay = document.querySelector('.popup-overlay');
    overlay.style.opacity = 0;
    setTimeout(function() {
      overlay.style.display = 'none';
    }, 300);
  }

  function closeSettingsPopup() {
    document.getElementById('SettingsPopup').style.display = 'none';
    var
      overlay = document.querySelector('.popup-overlay');
    overlay.style.opacity = 0;
    setTimeout(function() {
      overlay.style.display = 'none';
    }, 300);
  }

  function showSettingsPopup() {
    document.getElementById("SettingsPopup").style.display = "block";
    setTimeout(function() {
      document.getElementById("spopup-overlay").style.display = "block";
    }, 10); // Adjust the delay (in milliseconds) as
    needed
  }

  function closeSettingsPopup() {
    document.getElementById("spopup-overlay").style.display = "none";
    document.getElementById("SettingsPopup").style.display = "none";
  }
</script>
<script>
  var sortValue;
  var filterValue;
  var searchValue;

  document.getElementById('searchbar').addEventListener('keyup', function() {
    searchValue = document.getElementById("searchbar").value;
    loadXMLDoc("search");

    if (searchValue.trim() === "") {
      document.querySelector(".output").style.display = "none";
    } else {
      document.querySelector(".output").style.display = "flex";
    }
  });

  function loadXMLDoc(use) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (use == "search") {
          console.log("open Search function");
          getSearch(this);
        }
      }
    };
    xmlhttp.open("GET", "product.php?search=" + searchValue, true);
    xmlhttp.send();
  }

  function getSearch(xml) {
    var searchResults = xml.responseText;
    document.getElementById("demo").innerHTML = searchResults;
  }
</script>

</html>