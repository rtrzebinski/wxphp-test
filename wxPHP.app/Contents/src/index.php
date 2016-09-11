<?php

error_reporting(E_ALL);
date_default_timezone_set('GMT');
ini_set('log_errors', 1);
ini_set('error_log', './error.log');

class MainFrame extends wxFrame
{
    function onQuit()
    {
        $this->Destroy();
    }

    function onAbout()
    {
        $dlg = new wxMessageDialog(
            $this,
            "Welcome to wxPHP!!\nBased on wxWidgets 3.0.0\n\nThis is a minimal wxPHP sample!",
            "About box...",
            wxICON_INFORMATION
        );

        $dlg->ShowModal();
    }

    function randomBackgroundColour()
    {
        $this->SetBackgroundColour(new wxColour(rand(1, 255), rand(1, 255), rand(1, 255)));
    }

    function __construct()
    {
        parent::__construct(null, null, "PHP rulez", wxDefaultPosition, new wxSize(800, 600));

        // menu bar
        $mb = new wxMenuBar();
        $mn = new wxMenu();
        $mn->Append(2, "E&xit", "Quit this program");
        $mb->Append($mn, "&File");
        $this->Connect(2, wxEVT_COMMAND_MENU_SELECTED, array($this, "onQuit"));
        $mn = new wxMenu();
        $mn->AppendCheckItem(4, "&About...", "Show about dialog");
        $mb->Append($mn, "&Help");
        $this->Connect(4, wxEVT_COMMAND_MENU_SELECTED, array($this, "onAbout"));
        $this->SetMenuBar($mb);

        // status bar
        $sbar = $this->CreateStatusBar();
        $sbar->SetStatusText("Welcome to wxPHP...");

        // background color
        $this->SetBackgroundColour(new wxColour(rand(1, 255), rand(1, 255), rand(1, 255)));

        $mainBox = new wxBoxSizer(wxVERTICAL);

        // top
        $topBox = new wxBoxSizer(wxHORIZONTAL);
        $label = new wxStaticText($this, wxID_ANY, "This is horizontal box.");
        $topBox->Add($label, 0, wxALL, 10);
        $this->button = new wxButton($this, 8, "Click to change background color");
        $topBox->Add($this->button, 0, wxALL, 10);
        $this->Connect(8, wxEVT_COMMAND_BUTTON_CLICKED, array($this, "randomBackgroundColour"));

        // form
        $formBox = new wxBoxSizer(wxVERTICAL);
        $textbox1 = new wxTextCtrl($this, wxID_ANY, "This is read only form title", wxDefaultPosition, new wxSize(620,
            24), wxTE_READONLY);
        $formBox->Add($textbox1, 0, wxALL, 10);
        $textbox2 = new wxTextCtrl($this, wxID_ANY, "This is 2 lines textarea input - edit me :)", wxDefaultPosition,
            new wxSize(620, 48),
            wxTE_MULTILINE);
        $formBox->Add($textbox2, 0, wxALL, 10);
        $checkbox = new wxCheckBox($this, wxID_ANY, 'checkbox label');
        $formBox->Add($checkbox, 0, wxALL, 10);

        // grid
        $values = array(array(1, 2, 3), array(4, 5, 6), array(7, 8, 9)); // data for grid
        $vbox = new wxBoxSizer(wxVERTICAL);
        $gridview = new wxGrid($this, wxID_ANY, wxDefaultPosition, wxDefaultSize, wxTE_READONLY);
        $vbox->Add($gridview, 0, wxALL, 10);
        //grid options
        $gridview->CreateGrid(3, 3);
        $gridview->EnableEditing(false);
        $gridview->EnableGridLines(true);
        $gridview->SetGridLineColour(new wxColour(240, 240, 240));
        $gridview->EnableDragGridSize(false);
        // row options
        $gridview->SetRowLabelSize(50);
        $gridview->SetRowLabelAlignment(wxALIGN_LEFT, wxALIGN_CENTRE);
        $gridview->SetDefaultRowSize(24, false);
        $gridview->SetRowLabelValue(0, "Fish");
        $gridview->SetRowLabelValue(1, "Chips");
        $gridview->SetRowLabelValue(2, "Beers");
        // column options
        $gridview->EnableDragColSize(true);
        $gridview->SetColLabelSize(24);
        $gridview->SetColLabelAlignment(wxALIGN_CENTRE, wxALIGN_CENTRE);
        $gridview->SetColLabelValue(0, "Tom");
        $gridview->SetColLabelValue(1, "Dick");
        $gridview->SetColLabelValue(2, "Harry");
        $gridview->SetColSize(0, 50);
        $gridview->SetColSize(1, 100);
        $gridview->SetColSize(2, 50);
        // cell options
        $gridview->SetDefaultCellAlignment(wxALIGN_RIGHT, wxALIGN_CENTRE);
        // lay out the grid using the options given
        $gridview->Layout();
        for ($row = 0; $row < 3; $row++) {
            for ($col = 0; $col < 3; $col++) {
                $gridview->SetCellValue($row, $col, $values[$row][$col]);
            }
        }

        // setup
        $mainBox->Add($topBox, 0, wxALL, 0);
        $mainBox->Add($formBox, 0, wxALL, 0);
        $mainBox->Add($vbox, 0, wxALL, 0);
        $this->SetSizer($mainBox);
    }
}

class MyApp extends wxApp
{
    function OnInit()
    {
        $this->mf = new mainFrame();
        $this->mf->Show();
        return 0;
    }

    function OnExit()
    {
        return 0;
    }
}

$app = new MyApp();
wxApp::SetInstance($app);
wxEntry();
