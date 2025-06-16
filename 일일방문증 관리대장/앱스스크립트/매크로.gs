function myFunction() {
  var spreadsheet = SpreadsheetApp.getActive();
  spreadsheet.setActiveSheet(spreadsheet.getSheetByName('설문지 응답 시트1'), true);
  spreadsheet.getRange('A1').activate();
  var currentCell = spreadsheet.getCurrentCell();
  spreadsheet.getActiveRange().getDataRegion().activate();
  currentCell.activateAsCurrentCell();
  spreadsheet.getActiveSheet().sort(1, true);
  spreadsheet.getActiveRangeList().setHorizontalAlignment('left');
};

function myFunction1() {
  var spreadsheet = SpreadsheetApp.getActive();
  spreadsheet.getRange('A:B').activate();
  spreadsheet.setActiveSheet(spreadsheet.getSheetByName('방문증 관리'), true);
  spreadsheet.getRange('A:B').activate();
  spreadsheet.getRange('\'설문지 응답 시트1\'!A:B').copyTo(spreadsheet.getActiveRange(), SpreadsheetApp.CopyPasteType.PASTE_NORMAL, false);
};

function myFunction2() {
  var spreadsheet = SpreadsheetApp.getActive();
  spreadsheet.setActiveSheet(spreadsheet.getSheetByName('방문증 관리'), true);
  spreadsheet.getRange('A1').activate();
  var currentCell = spreadsheet.getCurrentCell();
  spreadsheet.getActiveRange().getDataRegion().activate();
  currentCell.activateAsCurrentCell();
  spreadsheet.getActiveSheet().sort(1, true);
  spreadsheet.getActiveRangeList().setHorizontalAlignment('left');
};
