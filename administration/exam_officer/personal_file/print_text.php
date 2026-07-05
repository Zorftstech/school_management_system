<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>class result detail</title>

    

    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            list-style-type: none;
        }

        
        






        #reg_section{
            width: 90%;
            margin-left: 5%;
            border-radius: 5px;
        }

        .reg_header{
            
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            position: relative;
            padding: 5px 0;
            height: 30px;
        }

        .reg_header h2{
            color: #444;
            text-transform: capitalize;
            letter-spacing: 1px;
            position: absolute;
            font-size: 15px;
        }

        .reg_header .session{
            right: 0;
        }

        .reg_header .class{
            left: 0;
        }







        #id_container{
            width: 90%;
            margin-left: 5%;
            position: relative;
            margin-top: 10px;
        }

        

        .key{
            text-transform: capitalize;
            font-size: 15px;
            font-weight: 700;
        }

       

        #name{
            position: absolute;
            left: 40%;
            top: 0;
        }

        .value{
            margin-left: 20px;
            text-transform: capitalize;
            font-size: 15px;
            color: #444;
        }







        #subject_table_contaner{
            width: 90%;
            margin-left: 5%;
        }

        #subject_table_contaner table{
           width: 100%;
           border-collapse: collapse;
        }

        #subject_table_contaner table td, #subject_table_contaner table th{
            border: 1px solid #444;
        }

        .subject{
            width: 30%;
            height: 20px;
            padding: 2px 0;
            padding-left: 0.6rem;
            text-transform: capitalize;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 0.05rem;
        }

        .score{
            width: 5%;
            height: 20px;
            padding: 5px 0;
            text-align: center;
            font-size: 14px;
        }


        /* styling attendance??????????????????????????????????????*/

        #attendance_container{
            width: 90%;
            margin-left: 5%;
            margin-top: 5px;
            position: relative;
        }


       

        #no_studenet{
            position: absolute;
            left: 40%;
            top: 0;
        }

        .attendance_key{
            font-size: 15px;
            color: #444;
            font-weight: 600;
            text-transform: capitalize;
        }

        .attendance_value{
            color: #444;
            font-size: 15px;
            margin-left: 20px;
        }


        /* styling teacher comment on result ???????????????? */

        #form_teacher_report{
            width: 90%;
            margin-left: 5%;
            position: relative;
        }

        #teacher_report{
            width: 83%;
            border: 1px solid #444;
            height: 140px;
            position: relative;
           
        }

        #teacher_comment{
            width: 70%;
            padding-left: 10px;
            padding-top: 5px;
        }

        #teacher_comment h4{
            text-transform: uppercase;
        }

        #teacher_comment p{
            text-transform: capitalize;
        }

        #teacher_rating{
            width: 30%;
            height: 40%;
            position: absolute;
            left: 55%;
            top: 5px;
            
        }

        

        .rate_key{
            text-transform: capitalize;    
            margin-left: 30px;
        }

        .rate_value{
            width: 20px;
            height: 20px;
            border: 1px solid #444;
            margin-left: 10px;
        }

        #rating{
            width: 15%;
            text-transform: capitalize;
            border: 1px solid #444;
            padding-left: 5px;
            padding-top: 5px;
            height: 120px;
            position: absolute;
            left: 85%;
            top: 0;
        }

        /* principal comment?????????????? */

        #principal_comment{
            width: 90%;
            margin-left: 5%;
            height: 100px;
            border: 1px solid #444;
            margin-top: 10px;
            padding-left: 5px;
            padding-top: 5px;
        }

        #principal_comment h4{
            text-transform: uppercase;
        }


        #begining_next_term{
            width: 72%;
            margin-top: 10px;
            text-align: center;
            margin-bottom: 40px;
            font-size: 15px;
        }

        #begining_next_term h4{
            text-transform: capitalize;
        }

        /* printing button styling????????? */

        

        
    </style>


</head>
<body>

    

    <section id="reg_section">
        <div class="reg_header">
            <h2 class="clas">jss2 first term result</h2>
            <p id="error" style="color: red;"></p>
            <p id="success" style="color: blue;"></p>
            <h2 class="session">2021/2022</h2>
        </div>
    </section>


    <div id="id_container">

        <div id="addmission_number">
            <table>
                <tr>
                    <td><p class="key">addmission number:</p></td>
                    <td><p class="value">2021/2022</p></td>
                </tr>
            </table>
            
        </div>

        <div id="name">
            <table>
                <tr>
                    <td><p class="key">name:</p></td>
                    <td><p class="value">akinyemi saheed akinwale</p></td>
                </tr>
            </table>
            
        </div>


    </div>

    <div id="subject_table_contaner">
        <table>
            <thead>
                <tr>
                    <th class="subject">subject</th>
                    <th class="score">ca1</th>
                    <th class="score">ca2</th>
                    <th class="score">ca3</th>
                    <th class="score">exam</th>
                    <th class="score">total</th>
                    <th class="score">grd</th>
                    <th class="score">posn</th>
                    <th class="score">max</th>
                    <th class="score">min</th>
                    <th class="score">avg</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="subject">english language</td>
                    <td class="score">5</td>
                    <td class="score">6</td>
                    <td class="score">8</td>
                    <td class="score">45</td>
                    <td class="score">65%</td>
                    <td class="score">A</td>
                    <td class="score">5</td>
                    <td class="score">68</td>
                    <td class="score">76</td>
                    <td class="score">67.87</td>
                </tr>

                <tr>
                    <td class="subject">english language</td>
                    <td class="score">5</td>
                    <td class="score">6</td>
                    <td class="score">8</td>
                    <td class="score">45</td>
                    <td class="score">65%</td>
                    <td class="score">A</td>
                    <td class="score">5</td>
                    <td class="score">68</td>
                    <td class="score">76</td>
                    <td class="score">67.87</td>
                </tr>
                <tr>
                    <td class="subject">english language</td>
                    <td class="score">5</td>
                    <td class="score">6</td>
                    <td class="score">8</td>
                    <td class="score">45</td>
                    <td class="score">65%</td>
                    <td class="score">A</td>
                    <td class="score">5</td>
                    <td class="score">68</td>
                    <td class="score">76</td>
                    <td class="score">67.87</td>
                </tr>
                <tr>
                    <td class="subject">english language</td>
                    <td class="score">5</td>
                    <td class="score">6</td>
                    <td class="score">8</td>
                    <td class="score">45</td>
                    <td class="score">65%</td>
                    <td class="score">A</td>
                    <td class="score">5</td>
                    <td class="score">68</td>
                    <td class="score">76</td>
                    <td class="score">67.87</td>
                </tr>
                <tr>
                    <td class="subject">english language</td>
                    <td class="score">5</td>
                    <td class="score">6</td>
                    <td class="score">8</td>
                    <td class="score">45</td>
                    <td class="score">65%</td>
                    <td class="score">A</td>
                    <td class="score">5</td>
                    <td class="score">68</td>
                    <td class="score">76</td>
                    <td class="score">67.87</td>
                </tr>
                <tr>
                    <td class="subject">english language</td>
                    <td class="score">5</td>
                    <td class="score">6</td>
                    <td class="score">8</td>
                    <td class="score">45</td>
                    <td class="score">65%</td>
                    <td class="score">A</td>
                    <td class="score">5</td>
                    <td class="score">68</td>
                    <td class="score">76</td>
                    <td class="score">67.87</td>
                </tr>
                <tr>
                    <td class="subject">english language</td>
                    <td class="score">5</td>
                    <td class="score">6</td>
                    <td class="score">8</td>
                    <td class="score">45</td>
                    <td class="score">65%</td>
                    <td class="score">A</td>
                    <td class="score">5</td>
                    <td class="score">68</td>
                    <td class="score">76</td>
                    <td class="score">67.87</td>
                </tr>
                <tr>
                    <td class="subject">english language</td>
                    <td class="score">5</td>
                    <td class="score">6</td>
                    <td class="score">8</td>
                    <td class="score">45</td>
                    <td class="score">65%</td>
                    <td class="score">A</td>
                    <td class="score">5</td>
                    <td class="score">68</td>
                    <td class="score">76</td>
                    <td class="score">67.87</td>
                </tr>
                <tr>
                    <td class="subject">english language</td>
                    <td class="score">5</td>
                    <td class="score">6</td>
                    <td class="score">8</td>
                    <td class="score">45</td>
                    <td class="score">65%</td>
                    <td class="score">A</td>
                    <td class="score">5</td>
                    <td class="score">68</td>
                    <td class="score">76</td>
                    <td class="score">67.87</td>
                </tr>
                <tr>
                    <td class="subject">english language</td>
                    <td class="score">5</td>
                    <td class="score">6</td>
                    <td class="score">8</td>
                    <td class="score">45</td>
                    <td class="score">65%</td>
                    <td class="score">A</td>
                    <td class="score">5</td>
                    <td class="score">68</td>
                    <td class="score">76</td>
                    <td class="score">67.87</td>
                </tr>
                <tr>
                    <td class="subject">english language</td>
                    <td class="score">5</td>
                    <td class="score">6</td>
                    <td class="score">8</td>
                    <td class="score">45</td>
                    <td class="score">65%</td>
                    <td class="score">A</td>
                    <td class="score">5</td>
                    <td class="score">68</td>
                    <td class="score">76</td>
                    <td class="score">67.87</td>
                </tr>
                <tr>
                    <td class="subject">english language</td>
                    <td class="score">5</td>
                    <td class="score">6</td>
                    <td class="score">8</td>
                    <td class="score">45</td>
                    <td class="score">65%</td>
                    <td class="score">A</td>
                    <td class="score">5</td>
                    <td class="score">68</td>
                    <td class="score">76</td>
                    <td class="score">67.87</td>
                </tr>
                <tr>
                    <td class="subject">english language</td>
                    <td class="score">5</td>
                    <td class="score">6</td>
                    <td class="score">8</td>
                    <td class="score">45</td>
                    <td class="score">65%</td>
                    <td class="score">A</td>
                    <td class="score">5</td>
                    <td class="score">68</td>
                    <td class="score">76</td>
                    <td class="score">67.87</td>
                </tr>
                <tr>
                    <td class="subject">english language</td>
                    <td class="score">5</td>
                    <td class="score">6</td>
                    <td class="score">8</td>
                    <td class="score">45</td>
                    <td class="score">65%</td>
                    <td class="score">A</td>
                    <td class="score">5</td>
                    <td class="score">68</td>
                    <td class="score">76</td>
                    <td class="score">67.87</td>
                </tr>
                <tr>
                    <td class="subject">english language</td>
                    <td class="score">5</td>
                    <td class="score">6</td>
                    <td class="score">8</td>
                    <td class="score">45</td>
                    <td class="score">65%</td>
                    <td class="score">A</td>
                    <td class="score">5</td>
                    <td class="score">68</td>
                    <td class="score">76</td>
                    <td class="score">67.87</td>
                </tr>
                <tr>
                    <td class="subject">english language</td>
                    <td class="score">5</td>
                    <td class="score">6</td>
                    <td class="score">8</td>
                    <td class="score">45</td>
                    <td class="score">65%</td>
                    <td class="score">A</td>
                    <td class="score">5</td>
                    <td class="score">68</td>
                    <td class="score">76</td>
                    <td class="score">67.87</td>
                </tr>
                <tr>
                    <td class="subject">english language</td>
                    <td class="score">5</td>
                    <td class="score">6</td>
                    <td class="score">8</td>
                    <td class="score">45</td>
                    <td class="score">65%</td>
                    <td class="score">A</td>
                    <td class="score">5</td>
                    <td class="score">68</td>
                    <td class="score">76</td>
                    <td class="score">67.87</td>
                </tr>

            </tbody>

        </table>

    </div>



    <div id="attendance_container">

        <div id="attendance">
            <table>
                <tr>
                    <td><p class="attendance_key">attendance for the term:</p></td>
                    <td><p class="attendance_value">96%</p></td>
                </tr>
            </table>
            
        </div>

        <div id="no_studenet">
            <table>
                <tr>
                    <td><p class="attendance_key">number of student in class:</p></td>
                    <td><p class="attendance_value">45</p></td>
                </tr>
            </table>
            
        </div>
    </div>



    <div id="form_teacher_report">

        <div id="teacher_report">

            <div id="teacher_comment">
                <h4>form teacher report</h4>
                <p>mr arome yusuf</p>
            </div>

            <div id="teacher_rating">

                <table>
                    <tr>
                        <td><p class="rate_key">attentiveness</p></td>
                        <td><p class="rate_value"></p></td>
                        <td><p class="rate_key">curiousity</p></td>
                        <td><p class="rate_value"></p></td>
                    </tr>
                    <tr>
                        <td><p class="rate_key">punctuality</p></td>
                        <td><p class="rate_value"></p></td>
                        <td><p class="rate_key">honesty</p></td>
                        <td><p class="rate_value"></p></td>
                    </tr>
                    <tr>
                        <td><p class="rate_key">neatness</p></td>
                        <td> <p class="rate_value"></p></td>
                        <td><p class="rate_key">humility</p></td>
                        <td><p class="rate_value"></p></td>
                    </tr>

                    <tr>
                        <td><p class="rate_key">politeness</p></td>
                        <td><p class="rate_value"></p></td>
                        <td><p class="rate_key">tolerance</p></td>
                        <td><p class="rate_value"></p></td>
                    </tr>
                    <tr>
                        <td><p class="rate_key">relationship <br> with other</p></td>
                        <td><p class="rate_value"></p></td>
                    </tr>
                </table>

            
            
                

            </div>

        </div>



        <div id="rating">
            <ul>
                <h4>key to rating</h4>
                <ul>
                    <li>5 = excellent</li>
                    <li>4 = very good</li>
                    <li>3 = good</li>
                    <li>2 = fair</li>
                    <li>1 = poor</li>
                </ul>
            </ul>
        </div>
    </div>


    <!--principal comment on result-->
    <div id="principal_comment">
        <h4>principals report</h4>
    </div>


    <!-- begining of another term-->
    <div id="begining_next_term">
        <h4>next term start on monday, 6th january, 2014</h4>
    </div>






</body>
</html>











