document.addEventListener("DOMContentLoaded", async function () {
  
  const SchemaUrl = document.getElementById("survey_url").textContent;
  const ResultsUrl = document.getElementById("result_url").textContent;
  const survey_id  = document.getElementById("survey_id").textContent;

  Promise.all([fetch(SchemaUrl), fetch(ResultsUrl)])
    .then(async responses => {
        if (!responses[0].ok || !responses[1].ok)
        {
          throw new Error(`Network issues: ${responses[0].status} ${responses[1].status}`);
        }

        const [surveySchemaResponse, surveyResultsResponse] = responses;

        const surveySchema = await surveySchemaResponse;
        const surveyResults = await surveyResultsResponse;

        return [surveySchemaResponse, surveyResultsResponse];
      })
    .then(([surveySchema, surveyResults]) => {

      console.log('Survey Schema: ', surveySchema);
      console.log('Survey Results: ', surveyResults);

      const survey = new Survey.Model(surveySchema);

      const vizPanelOptions = {
        allowHideQuestions: false
      };

      // Container element for the SurveyJS Analytics rendering
      const vizPanel = new SurveyAnalytics.VisualizationPanel(
        surveySchema,
        surveyResults,
        vizPanelOptions
      );

      vizPanel.render("surveyVizPanel");
    })
    .catch(error => {
      console.error("Error fetching data:", error);
    });
});
