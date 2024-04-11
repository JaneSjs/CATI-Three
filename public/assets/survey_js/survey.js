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

        /**
         * Save Survey When User Clicks the "Next" button
         * This feature is Still Work in Progress
         */

        // survey.onCurrentPageChanged.add(function (sender, options)
        // {
        //   if (sender.currentPage.isStartPage || sender.currentPage.isFirstPage)
        //   {
        //     console.log("Its Start page");
        //     surveyStartPage(sender);
        //   }
        //   else
        //   {
        //     console.log("Its Other pages");
        //     surveyNextPages(sender);
        //   }
        // });

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
  const post_result_url = document.getElementById("post_result_url").innerHTML;
  const patch_result_url = document.getElementById("patch_result_url").innerHTML;
  const csrf = document.querySelector('meta[name="csrf-token"]').content;
  let resultId;

  console.log('POST Result Url: ',post_result_url);
  console.log('PATCH Result Url: ',patch_result_url);
  console.log('CSRF Token: ', csrf);

  async function saveSurveyResults(url, json, page = null, httpMethod = "POST")
  {
    try {

      console.log("Result Url Used: ", url);
      
      data = {
        user_id: user_id,
        survey_id: survey_id,
        interview_id : interview_id,
        project_id : project_id,
        respondent_id : respondent_id,
        content: json,
      };

      if (geolocationData)
      {
        data.latitude  = geolocationData.latitude;
        data.longitude = geolocationData.longitude; 
        data.altitude  = geolocationData.altitude;
        data.altitude_accuracy = geolocationData.altitudeAccuracy;
        data.position_accuracy = geolocationData.accuracy;
        data.heading = geolocationData.heading;
        data.speed   = geolocationData.speed;
        data.timestamp = geolocationData.timestamp;
      }

      if (page !== null)
      {
        data.page = page;
      }

      // Create new Record
      const options = {
        method: httpMethod,
        body: JSON.stringify(data),
        headers: {
          "Content-Type": "application/json; charset=UTF-8",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": csrf,
        },
        credentials: "same-origin",
      };


      const response = await fetch(url, options);
      if (response.ok) {
        const surveyResult = await response.json();
        resultId = surveyResult.id;

        // Display Interview Complete Button
        setTimeout(() => {
          console.log("Complete Interview Button To Be Visible");
          document.getElementById('completeInterview').classList.remove('invisible')
        }, 100);

        // Toastify Notifications
        Toastify({
          text: "Results Recorded Successfully",
          duration: 8000,
          destination: "https://cati.tifaresearch.com/projects",
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

        console.log('Results Submitted Successfully', surveyResult);
      } else {
        throw new Error('Server Error. Check Server Logs');
      }
    } catch (error) {
      console.log(error);

      // Toastify Notifications
        Toastify({
          text: "Something Went Wrong. Results Not Submitted Successfully",
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
            console.log("Position Data:", position);
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
            console.log("Geolocation Error:", error);
            reject(error);
          }
        );
      } else {
        reject(new Error('Geolocation is not supported or enabled on this browser.'));
      }
    });
  }

  function surveyStartPage(sender)
  {
    let nextPage = sender.currentPage.visibleIndex + 1;
    let httpMethod = "POST";

    let url = post_result_url;

    saveSurveyResults(url, survey.data, nextPage, httpMethod);
  }

  function surveyNextPages(sender)
  {
    let nextPage = sender.currentPage.visibleIndex + 1;
    let httpMethod = "PATCH";

    if (!resultId)
    {
      console.error("resultId is not available");
    }

    let url = patch_result_url + "/" + resultId;

    saveSurveyResults(url, survey.data, nextPage, httpMethod);
  }

  function surveyComplete(sender)
  {
    console.log('Survey complete:', sender);
    const surveyData = sender.data;
    //const currentPage = sender.currentPage;

    // console.log('Survey Data:', surveyData);
    // if (!resultId)
    // {
    //   console.error("resultId is not available");
    // } 

    // httpMethod = "PATCH";
    // let url = patch_result_url + "/" + resultId;

    httpMethod = "POST";
    let url = post_result_url;

    saveSurveyResults(url, surveyData, null, httpMethod);
  }

});
