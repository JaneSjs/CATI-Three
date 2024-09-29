document.addEventListener("DOMContentLoaded", async function () {
  
  const survey_url = document.getElementById("survey_url").textContent;
  const result_url = document.getElementById("result_url").textContent;
  const survey_id  = document.getElementById("survey_id").textContent;
  const dev_licence = document.getElementById("dev_licence").textContent;

  Promise.all([fetch(survey_url), fetch(result_url)])
    .then(async responses => {
        if (!responses[0].ok || !responses[1].ok)
        {
          throw new Error(`Network issues: ${responses[0].status} ${responses[1].status}`);
        }

        const [surveySchemaResponse, surveyResultsResponse] = responses;

        const surveySchema = await surveySchemaResponse.json();
        const surveyResults = await surveyResultsResponse.json();

        return [surveySchema, surveyResults];
      })
    .then(([surveySchema, surveyResults]) => {

      console.log('Survey Schema: ', surveySchema);
      console.log('Survey Results: ', surveyResults);

      // Activate Developer Licence
      Survey.slk(dev_licence);
      console.log("Developer Licence", dev_licence);

      // Extract and Parse content from surveyResults.result
      let parsedResults = [];

      try
      {
        if (Array.isArray(surveyResults.result))
        {
          parsedResults = surveyResults.result.map((result, index) => {
            try
            {
              console.log(`Parsing result content at index ${index}: `, result.content);

              parsedContent = JSON.parse(result.content);

              return parsedContent;
            }
            catch(e)
            {
              console.error("Error Parsing Result Content at index ${index}:", result.content, e);
              // Skip this result if parsing fails
              return null;
            }
          }).filter(Boolean); // Remove null entries.
        }
        else if (typeof surveyResults.result === "object")
        {
          // Wrap the object inside an array
          parsedResults = [JSON.parse(surveyResults.result.content)];
        }
        else
        {
          console.log("Survey result format is unrecognized");
        }
      }
      catch(error)
      {
        console.log("Error Parsing Survey Results:", error);
      }

      // Parsed Results needs to be an array of survey response objects
      console.log('Parsed Results: ', parsedResults);


      const parsedSchema = JSON.parse(surveySchema.survey.content);

      const survey = new Survey.Model(parsedSchema);

      const vizPanelOptions = {
        allowHideQuestions: false
      };

      // Container element for the SurveyJS Analytics rendering
      const vizPanel = new SurveyAnalytics.VisualizationPanel(
        // How Do I Pass only the needed questions ?
        survey.getAllQuestions(),
        parsedResults,
        vizPanelOptions
      );

      vizPanel.render(document.getElementById("surveyVizPanel"));
    })
    .catch(error => {
      console.error("Error fetching data:", error);
    });
});
