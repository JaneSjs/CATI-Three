document.addEventListener("DOMContentLoaded", async function () {
  const survey_url = document.getElementById("survey_url").textContent;
  const survey_id  = document.getElementById("survey_id").textContent;
  const user_id    = document.getElementById("user_id").textContent;
  const interview_id = document.getElementById("interview_id").textContent;
  const project_id = document.getElementById("project_id").textContent;
  const respondent_id = document.getElementById("respondent_id").textContent;

  console.log('survey url:', survey_url);
  console.log('survey id:',survey_id);
  console.log('user id:',user_id);
  console.log('interview id:',interview_id);
  console.log('project id:',project_id);
  console.log('respondent id:',respondent_id);

  let survey; // Declare the survey variable outside fetchSurvey()
  let geolocationData;

  async function fetchSurvey() {
    try {
      const response = await fetch(survey_url);

      if (response.ok) {
        const responseData = await response.json();

        console.log(responseData);

        // Parse the survey content from the response
        const surveyContent = JSON.parse(responseData.survey.content);

        const surveyJson = surveyContent;

        // Create the SurveyJS instance with the generated model
        survey = new Survey.Model(surveyJson);

        // Render survey inside the page
        ko.applyBindings({
          model: survey
        });

        // Add the onComplete event handler
        survey.onComplete.add(surveyComplete);

        // Store Geolocation details in a variable
        geolocationData = await getCurrentPosition();

      } else {
        throw new Error('Error fetching data: ');
      }
    } catch (error) {
      console.error(error);
    }
  }

  fetchSurvey();

  /**
   * Collecting Survey Results
   */
  const result_url = document.getElementById("result_url").innerHTML;
  const csrf = document.querySelector('meta[name="csrf-token"]').content;

  console.log('Result Url: ',result_url);
  console.log('CSRF Token: ', csrf);

  async function saveSurveyResults(result_url, json) {
    try {
      
      data = {
        user_id: user_id,
        survey_id: survey_id,
        interview_id : interview_id,
        project_id : project_id,
        respondent_id : respondent_id,
        latitude: geolocationData.latitude,
        longitude: geolocationData.longitude, 
        altitude: geolocationData.altitude,
        altitude_accuracy: geolocationData.altitudeAccuracy,
        position_accuracy: geolocationData.accuracy,
        heading: geolocationData.heading,
        speed: geolocationData.speed,
        timestamp: geolocationData.timestamp,
        content: json,
      };

      // Create new Record
      const options = {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
          "Content-Type": "application/json; charset=UTF-8",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": csrf,
        },
        credentials: "same-origin",
      };

      console.log(data);

      const response = await fetch(result_url, options);
      if (response.ok) {

        // Toastify Notifications
        Toastify({
          text: "Results Recorded Successfully",
          duration: 8000,
          destination: "https://github.com/apvarun/toastify-js",
          newWindow: true,
          close: true,
          gravity: "top", // `top` or `bottom`
          position: "center", // `left`, `center` or `right`
          stopOnFocus: true, // Prevents dismissing of toast on hover
          style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)",
          },
          onClick: function(){} // Callback after click
        }).showToast();
        // End Toastify Notifications

        console.log('Results Submitted Successfully');

        const surveyResult = await response.json();
        console.log(surveyResult);
      } else {
        throw new Error('Server Error. Check Server Logs');
      }
    } catch (error) {
      console.log(error);

      // Toastify Notifications
        Toastify({
          text: "Results Not Submitted Successfully because your browser has not allowed Geolocation access to this application. Geolocation access is required in order for the Survey Results to be submitted successfully.",
          duration: 9000,
          destination: "https://cati.tifaresearch.com/projects",
          newWindow: true,
          close: true,
          gravity: "top", // `top` or `bottom`
          position: "center", // `left`, `center` or `right`
          stopOnFocus: true, // Prevents dismissing of toast on hover
          style: {
            background: "linear-gradient(to right, #ff0000, #ff4d4d)",
          },
          onClick: function(){} // Callback after click
        }).showToast();
      // End Toastify Notifications
    }
  }

  // Function to get the current position (latitude and longitude)
  function getCurrentPosition() {
    return new Promise((resolve, reject) => {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          position => {
            resolve({
              latitude: position.coords.latitude,
              longitude: position.coords.longitude,
              altitude: position.coords.altitude,
              altitude_accuracy: position.coords.altitudeAccuracy,
              position_accuracy: position.coords.accuracy,
              heading: position.coords.heading,
              speed: position.coords.speed,
              timestamp: position.timestamp,
            });
          },
          error => {
            reject(error);
          }
        );
      } else {
        reject(new Error('Geolocation is not supported by this browser.'));
      }
    });
  }


  function surveyComplete(sender) {
    console.log('Survey complete:', sender);
    const surveyData = sender.data;

    console.log('Survey Data:', surveyData);

    saveSurveyResults(result_url, surveyData);
  }

});
