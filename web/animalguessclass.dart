import 'package:polymer/polymer.dart';
import 'dart:html';
import 'dart:convert';


/**
 * A Polymer click counter element.
 */
@CustomTag('animal-guess')
class AnimalGuess extends PolymerElement {
  @published bool gameinprogress=false;
  @published String question='';
  @published String myguess='';
  @published int qid=1;
  int yBranch;
  int nBranch;
  @published bool win=false;
  @published bool lost=false;
  @published bool reachedend=false;
  @published String myanimal='';
  @published String mybranch='';
  @published String youranimal='';
  @published String newquestion='';
  @published bool wronganswer=false;
  @published bool wrongquestion=false;

  AnimalGuess.created() : super.created() {
    // The below 2 lines make sure the Bootstrap CSS will be applied
    var root = getShadowRoot("animal-guess");
    root.applyAuthorStyles = true;
  }

  void newGame() {
    gameinprogress=true;
    win=false;
    lost=false;
    reachedend=false;
    qid=1;
    getQuestionById(qid);
  }
  
  void getQuestionById(qid)
  {
    var path='http://rsywx/app_dev.php/animal/getQuestionById/$qid';
    var req=new HttpRequest();
    req..open('GET', path)
      ..onLoadEnd.listen((e)=>requestComplete(req))
      ..send('');
  }
  
  void YBranch()
  {
    if(yBranch==-1 && nBranch==-1) // No more questions to ask and I guessed it!
    {
      win=true;
      reachedend=true;
      gameinprogress=false;
    }
    else
    {
      getQuestionById(yBranch);
      qid=yBranch;
    }
  }
  
  void NBranch()
  {
    if(yBranch==-1 && nBranch ==-1) //No more questions to ask and I did not make it. 
    {
      lost=true; // Show the input area for more questions
      reachedend=true;
      myanimal=myguess;
    }
    else
    {      
      getQuestionById(nBranch);
      qid=nBranch;
    }
  }
  
  void requestComplete(HttpRequest req)
  {
    if (req.status==200)
    {
      Map res=JSON.decode(req.responseText);
      myguess=res['q'];
      yBranch=res['y'];
      nBranch=res['n'];
      
      if (yBranch==-1 && nBranch==-1) // No more branches and we have reached the "guess"
      {
        question='Is it a/an $myguess?';
      }
      else
      {
        question=myguess;
      }
    }
  }
  
  void submitForm(Event e)
  {
    var path;
    if(newquestion.endsWith('?'))
    {
      wrongquestion=true;
      return;
    }
    else
    {
      wrongquestion=false;
    }
    
    if(mybranch.toLowerCase()=='y'||mybranch.toLowerCase()=='yes') // Y to my guessed animal, N to the animal in player's mind
    {
      wronganswer=false;
      path='http://rsywx/app_dev.php/animal/setNewQuestion/$qid/$newquestion/$myanimal/$youranimal';
    }
    else if (mybranch.toLowerCase()=='n'||mybranch.toLowerCase()=='no')
    {
      wronganswer=false;
      path='http://rsywx/app_dev.php/animal/setNewQuestion/$qid/$newquestion/$youranimal/$myanimal';
    }
    else // Not recognized answer
    {
      wronganswer=true;
      return;
    }
    
    if(!wronganswer && !wrongquestion)
    {
      var req=new HttpRequest();
      req..open('GET', path)
        ..onLoadEnd.listen((e)=>newQuestionComplete(req))
          ..send('');
    }
    return;
  }
  
  void newQuestionComplete(req)
  {
    wronganswer=false;
    wrongquestion=false;
    newGame();
  }
}




