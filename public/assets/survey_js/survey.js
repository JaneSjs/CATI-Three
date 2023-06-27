document.addEventListener("DOMContentLoaded", async function () {
  const survey_url = document.getElementById("survey_url");
  const survey_id  = document.getElementById("survey_id");
  const user_id    = document.getElementById("user_id");

  console.log('survey url:', survey_url.textContent);
  console.log('survey id:',survey_id.textContent);
  console.log('user id:',user_id.textContent);

  let survey; // Declare the survey variable outside fetchSurvey()

  async function fetchSurvey() {
    try {
      const response = await fetch(survey_url.textContent);

      if (response.ok) {
        const responseData = await response.json();

        console.log(responseData);

        // Parse the survey content from the response
        const surveyContent = JSON.parse(responseData.survey.content);

        // // Process the fetched survey content and create a SurveyJS model
        // const elements = surveyContent.pages[0].elements.map(item => ({
        //   name: item.name,
        //   title: item.title,
        //   type: item.type
        // }));

        // const surveyJson = {
        //   elements: elements
        // };

        // console.log('Survey JSON: ', surveyJson);

        const surveyJson = surveyContent;

        // Create the SurveyJS instance with the generated model
        survey = new Survey.Model(surveyJson);

        // Render survey inside the page
        ko.applyBindings({
          model: survey
        });

        // Add the onComplete event handler
        survey.onComplete.add(surveyComplete);
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
  console.log(csrf);

  async function saveSurveyResults(result_url, json) {
    try {
      const position = await getCurrentPosition();

      const data = {
        user_id: user_id.textContent,
        survey_id: survey_id.textContent,
        latitude: position.latitude,
        longitude: position.longitude, 
        altitude: position.altitude,
        altitude_accuracy: position.altitudeAccuracy,
        position_accuracy: position.accuracy,
        heading: position.heading,
        speed: position.speed,
        timestamp: position.timestamp,
        content: json,
      };

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
        console.log('Results Submitted Successfully');

        const surveyResult = await response.json();
        console.log(surveyResult);
      } else {
        throw new Error('Server Error. Check Logs');
      }
    } catch (error) {
      console.error('Error: ', error);
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
