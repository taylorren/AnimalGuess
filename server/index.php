<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to the legacy Guess Animal Program!</title>
    </head>
    <body>
        <h1>Guess Animal (legacy) program</h1>

        <p>Guess Animal is a legacy program I encountered when I started to learn C/C++.</p>

        <p>The game is trying to mimic an AI by asking various questions about an animal that you (the user) have in mind. For every question, you will anwer Yes or No. The game will try to guess which animal you have in mind (as long as you are an honest human being and don't change your animal from question to question). If its guess is correct, it will be happy; if wrong, the program will prompt you to provide a Y/N question to distinguish the animal it guessed and the animal you have in mind.</p>

        <p>Along the time, it will become smarter and smarter -- I mean, it will ask more questions before it prompts its answer and in a way, it improves the accuracy of the program's guess.</p>

        <p>For a start, it only has one question and two animals in mind (to be more exact, in the database): Does it swim? Dolphin for YES and cat for NO.</p>

        <p>The service running here is supposed to be a server only.</p>

        <h2>Detailed usage</h2>

        <table>
            <tr>
                <th>Calling URI</th>
                <th>Description</th>
                <th>Parameters</th>
                <th>Returns</th>
            </tr>
            <tr>
                <td>/get.php?id={id}</td>
                <td>Get the question or answer by ID</td>
                <td>
                    <ul>
                        <li>id: the ID of a question</li>
                    </ul>
                </td>
                <td>In JSON format:
                    <ul>
                        <li>The next question, or the guess of the animal.</li>
                    </ul>
                </td>
            </tr>
            
            <tr>
                <td>/set.php/?id={id}&amp;q={question}&amp;a1={animal1}&amp;a2={animal2}</td>
                <td>To set a new question to distinguish program's guess and the actual animal in human's mind.</td>
                <td>
                    <ul>
                        <li>id: the question id to be further splitted</li>
                        <li>question: a new question to distinguish two animals</li>
                        <li>animal1/animal2: for Y/N answers, respectively</li>
                    </ul>
                </td>
                <td>In JSON format: the max ID in the current database</td>

            </tr>
            <tr>
                <td>/getMaxID.php</td>
                <td>Get the max ID assigned in database, which is equivalent to the count of all records (including questions and guesses) in the table. </td>
                <td>None</td>
                <td>In JSON format:{"mid": "the max ID in the current database"}</td>
            </tr>
            <tr>
                <td>/getAnimalCount.php</td>
                <td>Get the animal count in a database.</td>
                <td>None</td>
                <td>In JSON format: {"aid": "the count of animals in the database". This is not equivalent to getMaxID.</td>
            </tr>

        </table>
    </body>


</html>
