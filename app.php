<?php

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

  function __construct()
  {
     parent::__construct(null, null, "Minimal wxPHP App", wxDefaultPosition, new wxSize(350, 260));

     $mb = new wxMenuBar();

     $mn = new wxMenu();
     $mn->Append(2, "E&xit", "Quit this program");
     $mb->Append($mn, "&File");

     $mn = new wxMenu();
     $mn->AppendCheckItem(4, "&About...", "Show about dialog");
     $mb->Append($mn, "&Help");

     $this->SetMenuBar($mb);

     $scite = new wxStyledTextCtrl($this);

     $sbar = $this->CreateStatusBar(2);
     $sbar->SetStatusText("Welcome to wxPHP...");

     $this->Connect(2, wxEVT_COMMAND_MENU_SELECTED, array($this,"onQuit"));
     $this->Connect(4, wxEVT_COMMAND_MENU_SELECTED, array($this,"onAbout"));
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

?>
