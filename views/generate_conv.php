<?php

require_once './assets/dompdf/vendor/autoload.php';
use Dompdf\Dompdf;

$cne = $_POST['cne'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$diplome = $_POST['diplome'];
$intitule = $_POST['intitule'];
$nomEntr = $_POST['nomEntr'];
$adrEntr = $_POST['adrEntr'];
$telEntr = $_POST['telEntr'];
$nomEncd = $_POST['nomEncd'];
$qltEncd = $_POST['qltEncd'];
$emailEncd = $_POST['emailEncd'];
$nomResp = $_POST['nomResp'];
$qltResp = $_POST['qltResp'];
$telResp = $_POST['telResp'];
$emailResp = $_POST['emailResp'];
$datedebut = date('d/m/Y', strtotime($_POST['datedebut']));
$datefin = date('d/m/Y', strtotime($_POST['datefin']));


$path_fst = './assets/images/logo-fstg.jpg';
$type_fst = pathinfo($path_fst, PATHINFO_EXTENSION);
$data_fst = file_get_contents($path_fst);
$base64_fst = 'data:image/' . $type_fst . ';base64,' . base64_encode($data_fst);


$html = '
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Convention ' . $nom . ' ' . $prenom . '</title>
    <style type="text/css">
        * {font-family: \'Noto Sans Arabic UI\', sans-serif;box-sizing: border-box;}
    </style>
</head>
<body>
    
    <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <img width="248" height="96"
                    src="data:image/jpg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wAARCABgAPgDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD9U6a7rGjO7BEUZLMcAD1NR3d3DYWs1zcypBbwoZJJZGCqigZLEnoAO9fnn+0l+1dd/FPVJvD2gXNxp/giOTy5pbb5Z9RAPLHOMR9wnG7q3oPMx+PpYCnzT1b2Xf8A4Hmerl+XVcwqcsNEt32/4PkfSPj39r/QdM1l/Dvgixfx14lO5UgtJVS3LqOVWQ/6xuPuoCTjg5r5m1P9sz4g614oig1y+l8OaKs/l3tnodusN1CnRsPKrtuXrg4zjHGa8e8UeCNV8DjStTSTz9JvwLjStbsiRFNtP8J6pIhHzIcMpH419XeD/DXhz9tH4XSTaj5OlfE7RUW3n1SFAGn4/dySqPvo4GD3VgcY6H4/65jcwm6anyTWqjsmu1+/XV2a7H2n1LA5dTjVlDng9HLdp97bW6aK6fc4b42aX8XPhzLpGraR8RvEXirwvrhRdN1G0u5A7PIAUidFOAzA/KRwfY8Vq+PNb+IP7PfgjS7rxD8StcvfHWr/AD2uircJNb2UQxveYyKxcjO3AwMnqQDXsX7Ht7qdj4b134ceLLRU1rwffL5cM4DgQuS8ToT1UMGKsOxWvM9G+Ed3+1r8a/EXjTW5ZrbwFY3bafZ7CVe8jhJUJGf4UJ3MzDuxA5yR0yw8nCNTDuXPU0Su/dt8T36PTXbzOaOIgqkqeJUeSnq5JL30/hS06rXTfyIfhX+2z48ks7u68ReGYvEeh2C7r3VrJfsjW46DcT+7ZieAg2kk8V9U/C740eEvjDphu/DeprcSxgGexmHl3MH++h5x7jI96+BP2m/irp/ibXYvBvhGCHTvAnh2Qw2trZqFjubgfK8xA+9g5VSc55PVq4qTSNf+DlzpGstqM+geK5VW6tLKA4uLeE9JJx0UP2jOSRywAxnGlm9fCVHCUvaQju/8n+V9/I2rZNh8ZTVSMfZTlsv81+drW8z9aKK8L/Zk/aVtPjbo7adqYisfF9jGGubZOEuU6edEPT+8v8JPoRXulfcUK9PE01VpO6Z8FiMPUwtR0qqs0FYlh4y0nU/FWq+HLe5L6vpcUM11B5bARpKCUO4jBzg9DW3Xjfgb/k5v4n/9g3Sv/QJK9ShRjVhVlL7Mbr/wKK/U86rUcJU0vtO34N/oeyUUUVxnQFFQS3tvBcQW8txFHPPu8qJ3AaTAydo6nA64qenZoAooopAFFecftDHX4vhDr9z4Zvhp2q2iJdrMRn5I3V2Ge2QpyeeMjHNdJaeL9L0yTStG1jxBpY8RTwR5tzcJHJO5GCyRk5wxBxgV1LDydJVYu921brok7+mpg6qVRwemid+mt9PU6OivI/iRd+JtN+N3wyfT9WFr4fvmu7K9syvErCIyjJPUkRgL0Iw3POK6T4TePJ/HPhe5vtQjS1vrfU72xmgXpGYrh0Vf++AnPfNXPCyhRjXTTTX3Xcl/7aTGvGVR0mrNfjon+p0+teIdL8N2jXOq6ja6dbqrOZLqVYxhVLMRk84AJNT6ZqdprWn21/YXMV5ZXMYlhuIHDpIhGQykcEGvNPj0ngG10K08QeMraxv7jS/POlW15ucXE7RMPKEQz5m7A4wcYB4xXY/D7ULa68A+Gp4oILGKXTLaRLWDiOEGJSEXrwOg+lEqMVh41kndu3l8u/QFUbrOm7Wtfz+fY6SiovtMX/PRfzo+0xf89FriOkloqL7TF/z0Wj7TF/z0X86AJaK8s/aRv9atvg14hvvDGqDT9T09UvPOj5bZE6u6g9uBznPGRjmuM8b/AB58Y2mt6R4E8FaJZeI/HLaZBe395dSiKzTcgLMo3KWBPPUYBHB7enh8vqYmCnTa1bvd2skk7tvS2pw1sXChJxmnsvO921ZLe+h9DUVT0yeV7G1F20ZvTEvnCI/L5mPmx7ZzRXmtWdjtWp8fft2fHKS3Mfw50a42l1W41iRD/CeY4D9eGYem0dzXhHhT4SWnxn8MXt54KH2XxfpUXm3/AIalkyl3H0860Y8j0MbE4PQ8gV9o/Ez9jvwD8SdR1DVXjvtI1y9dppb60uWbfIf4mR9yn6DFfLXiH4R+NP2P/iBo3jOJhrHh60uQH1G0UqGiY4eKZOdhZScHlc45zxX5/mOFxH1mVfFR5qb00+yuj7q2/Zn6LlmLw31aOHwkuWqtbP7T6rs77Lqug79lHxHpur6pqnwk8aWv2nw/r7OYLe5BVrS+Qc7c8o7AHpyGUeprQ0vw9rH7GX7Q+kS3s8lz4S1Rza/b8YWe1dgDvA4EkTbWI9BkcGvQv2uPhNGbPTfjR4IUR31oYL+9+zjAmTKtHcgD+IfKG9VOexz7j4y8IaL+0z8EbaOYIiatYx31lcgZNrOUyrA+xJUjuMiuilgaiTo3/e0rSg+8e3pf7r9jnrY+m3Gu1+6q3jOP8sl19bffbudJrvgSPUvEUviDTp1sdTudKm0uW4UZ8yNiGib3KNkj2dq8u/aP8YWX7Pn7P0eieH8WNzcQro+mqnDIpX95L7kLuOf7zA967b9nfxDqGu/CrS7fWVMevaM0mj6lG3VZ7dvLJPrlQrZ77s1w2t+C0+Nv7SYuNSj8/wAKeAoY41gfmO51KUCUgjoQieUSPXaO5r3a79pQUsOrTqaLyvv9yV35o+fw69niHHEO8KWr87aJed27LyZ5F8E/gdpnwU+HN58XPiBZLNqFnbfatL0i4HEBPETOD1ldioA/gBz16eFeDPAPjD9pLx5q2oCRPMlla81bWbs7ba0U88n2AwqDsvYDNfVf7Z02q/EDxF4G+FOgnN9rFwb+5z92OJMqrvj+Ff3jH/cFZ/7RVrbfA/4LeH/hT4HtppdV8Ry/ZnFuu65ukGPOcgclpGKr9CR0FfN4nB0o3pr+FS37ym+n5Ly6H1GGxtWXLUf8as9O0YLr+b8+p8r3vi7S/h1450+9+Hc07nRZ90et3ZIk1Fxwx8scJCwyAnJIOScnj9NvhX8RdP8Air4D0nxNp3yRXkWZISctBKOJIz7qwI9xg96+U/hR+wC93aQX/j/VJLV3Ab+yNLYbkHpJMQefZR/wKvq34c/C/wAOfCjRJNJ8M2LWFlJL50iNM8peTABYlieSAOmOlelkuGxlCUp1YqMJdOqfTT8769zy88xWCxEYwpScpx69Gut3+VtOx1deN+Bv+Tm/if8A9g3Sv/QJK9krxvwN/wAnN/E//sG6V/6BJX3+D/hYj/B/7fA+CxHx0f8AF/7bI3fj98RNO+HHw6vbu/1S40uS8YWdvJZRCS5Zm+8IgSAH2BsMThTgnOMHyX9jjx/4g1a/8R+Gb9dZutBs1F3pd9r0bi7EbNjync5DdjweOexAHrvxk0O4u4fCuuWNt9qvtD1y1nWPbu3Qyt5Ewx/uSls9toNdV4q0O+1zT1TTNZuND1CIl4LmFFkTdtIxJG3Ei8/d47EEEZrrpV6FPA+wcbub1k/stWtolfbz6vQ5qlKrUxSqKVlBbd73vre3T8EfJ37R+sat4L+PVn4svvDutX8WnS2P9hahaSYtdvW5tyu05eTc6jkHpwQK6T/huG6/6JZ4h/Nv/jddv4X+CfjHWPiBp/if4k+LbfxCNEcvpOnaZbm3tkkOR50in+MA8Dnt83GK9wrvxGNwUadKjUpKq4RtdSkl6L83oldvzOWlhcVKdSrCo6ak9mot/wBdF5JeR8sf8Nw3X/RLPEP5t/8AG6P+G4br/olniH82/wDjdfU9FcP13Lv+gT/yeR0/VsZ/0Ef+So+RfFH7Y914k8M6vpP/AArHxBD9vtJrXzDuITehXOPL5xnNeIeIrHWvH3iKx8dr4E8TNaad9j/tuUliZpIgi5gygMY2oOgbbnJxX6U0V3YbO6GCu8NhuVv+/J6df676nLXyuridK9a6/wAKR8pWv7Sdx8VfHXgbTP8AhX+s6NJBrcU63t0GaOMGOSN8/IMfLIec9cV7R8HtLm0268e74yltceJ7ue3JGNyskW8j28wOPwNei0gAHTivJxONpVIezoUuSNrbt9b9T0aOGqQlz1anM732S6W6HjHxV+DXjDx18R9G1/R/GUWg6dZWzWZgWzDzxJIf37xM2QJGAVQ2AQB16g+Y6J+01rPwi02LwTqfw61vVLrQC2ni9g3BJ4o2KxOP3Z6xhDnPPWvrairo5jH2ao4qkpwWy+FrfqtXu9yKuDbm6tCbjJ79e3R6LZbHyx/w3Bc/9Er8Q/mf/jdH/DcFz/0SvxD+Z/8AjdfU9Fa/Xcu/6BP/ACeRn9Wxn/QR/wCSo+WP+G4Ln/olfiH8z/8AG6P+G37n/olfiH8z/wDG6+p65/x7oOq+JvCd/puia5L4b1SZV8nU4YhI0JDA/dJGcgYPsTVwxeWykoywqSfXnlp56Eyw+NjFtV7+XLE+PLT9o68t0+INrP8AD/xLdab4rkeZbeUMTaGS3EUgB8vkHaCPT361geJvitZeJ9K8O3D/AA68U6Z400KxhtrPxLp7MkokjTCs6GPDpuySp5wSM819veBvB0ngyxvIJtd1TX5bq5e6a41SfzGQtjKIAAETOSFAAGa6Su55zhKVS9LD7W1U5K9lba3bR336nKsuxFSFqlXvpyp7u/56+XQ5j4Y+Irzxf8PfDutala/Y9QvrGKe4g2FdkhUbhg8jnPBorp6K+TqSU5ylFWTe3byPoIRcYKMndrr3CqOt6LY+I9IvNL1O2jvNPvImhnt5RlXRhgg1eorJpNWZom07o82+D2hRwfDSfwdqOb+30ae50OTz+fOt1YiLd9YXjzWf+zbpk/hLwbqngy5dpH8Matc6fCz/AHmtmImgb8Y5V/Kul+HxP9u+Ox2GucD/ALdLatLTtI/s7xzrV5GhEWpWtu7nt5sZdCfqVKD/AIDXn06aXs5r7N4/L/h0j0atVv2kJfatL5/8M2U9M0xPDfjnxBcIpSz1aCO/fHQTxjypDj1KCH/vk1N8N9BOheGEeVQL7UZ5dSu2xy00zlzn/dBVR7KK6Oa1iuDmRA52snPoeo/HFSABFwOFA/KuuNJRlf1/HVnJKq5Rt6fhojx74ceHF8Q/G74geO7pN5tpI/DumludkcKK07D6ysR/wA1q+H/C9t4j+NXiPxfeIs8mjQxaFpu4Z8n5BNcOPRmMypn0QjvXWeAtGbQ/C9tDIuLiZ5bubjkySyNK2fxc1l/DP/WeLz3PiC6/9BjrjhRSUFJbtyfrq/wv+COydaUnUlF7JRXpovxtr6s7WiiivSPMCvG/A3/JzfxP/wCwbpX/AKBJXsleN+Bv+Tm/if8A9g3Sv/QJK9PB/wALEf4P/b4HFiPjo/4v/bZHrkl1scr5TNjuBSfa/wDpi/5VFrmtWvh7SrjUL1zHbwAFsDJYkgKoHdiSAB3JFZ3jzxYngfwRrfiKS1lu102zkuzbxj5n2qTt9vr261wRpzm0ord2XqdblGN23sZOt/FCz0Hxtpnhy602/T7dbPcDVGi22UO1sBJJSQAxPAHPJUd60vFHj3RPA+kPqniHULfR7BDjz7mTaGPoo6sfYAmvMPG2j/DTxxe+GvFPiOOfU5PEFnFa2mlyXp8pl2G5UmHeBuXYRkd3AIJIrzTx9pc/xE1zwp8W38NQ+LvAzaOou/DFzKDcWK7jvkiiyFdgDnA5O0jHQj3qGX0azgptx3Ur2V5a2SbdruzWtlp3Z5FTF1KfM42ls1vtpdtJbK6ffU+ndL8daRrMumxWk7Sy6jY/2lbR7CGe3yg8zB6DLr19fatj7YP+ecn/AHzXjv23Sbn4sfCfxB4fKDR9Y0W9sIPJXYvkCOKeJdvbGxuO3SvVPFuuP4Z8Laxq8drJfSWFpLcrbQqS8pRCwUAdzjFeXXw/s5QUL+8tnunzONvwO+jWc1Jytp266J3/ABNBblGxkMD7qak3L6ivOvGXxs0nw34J0nWLMR6jqWuJEukaZ56RvcyypuRSWICKM/Mx6dOpAN34L/E+P4t+ArXXfsh0+9WR7W+siSfIuYziRAT1HQj2IqZYOvCi68o2inb5/wBLfa+g1iaUqipKWrV/kd1RWBrPj/wx4cvTZ6t4j0nTLsKHMF5exRSBT0O1mBwcHn2ratbqG+torm2mjuLeZBJHLEwZHUjIYEcEEd65nCcUpNaM2U4t2T1Jagnvbe3s5buSZFtokaR5Sw2qqjJJPtg15qzaP8fvAdtI2uXGm266kbhG0m88idfJmYLHIQSRkD5hx1GOgpl1caH8E9N8K+HdD0fztC1jWDY3DCbzRbmcSMHbcSWDSbV57H6Z7Vhf+Xd37S7VrdvNvfsrHO69vfsuS29/0/4J6F4c8Q2HizQdP1nS5xc6dfwJcW8wBG5GGQcHpWP8R/id4e+FGgJrPiS8NnZPOluhSNpHZ26AKuScAEnHYGuU/Zo1O0k+BfhIJPF+6tmiZN4yrLI6lcdsYqk/xMtvGXwa8R69q/heC6v9GkvUm0G7CSZltnbGM8ZKqrZHrxnjO/1NQxUoOLcIz5Xqk92lv6b2sYxxLnh4zTSlKN1o7Xtf+ka9h8fPD+s+OLfwzpdjrGo3DXTWdxeRafIttayCHzQJHYADK/jntXXSeOfD0XiK00FtZsv7ZuvN8myWYGRzGAZBgdCAQcHn8jXyv+0X8Z9f8O+PNA1nSdcvND0VLC01SztIYWMGruzkzRzOpwCsYUANkc9uDXstxo3gzwP468K6zpPhSwN14h1Gf7Tri4MttJLbswJYkkeYV246ct3PPdXy6nTp06nK1zRdknf3kr6tpL5K/bc5aWNnOc4XT5WtbW0fZav77d9jZ8PfH3wj4hi1x0uprVdH1RNIuDcQsoM8kpiiCHHzbjg8dAecV6PXyf8AFyxii8HfGyGMRm70rXNP8SQTRgZIZICDkdcGOUV9JeIPF9n4Z8E33ia93Cxs7Fr6QKMsVCbsD3PSuTGYOEIwnQT952tv9mDX38zOnDYicpSjVtot/wDt6S/JI3qK8s+BPxT1v4jWmu2nibSING17SbiMSQWknmRNBNGJYWDZOTtODg4yO2cArzcRQnhqjpVN12131WvodlGrGvBVIbM77w34p0rxfp8t7o97HfW0VzNaSPHkbJopGjkQg8gqykfr0IqhafEbw1feG9X8QQavbyaLpElzFe3wJ8uFrckTZOOQpVgSMjjjNeReHfDPiaDRY5PCf7m28Tz3VlqtwjhDpzrczD7cgP3nMQaPA5LCA9A1UIdMcaFN4C8PaVaXUF14pujJp1xKYYDp9q0bSIzhXIDN5KH5Tu8w56muc2PVBrOk/Dye+1C8vJ7xfE2pfabKGwspbmRv9GQbQsasSNsLNuwBg1PN8YfCyWmn3EN5dX6X/n+THY6fcXEo8kqs2+NELRlC6ghwCCcV5Tpmr+INFi8C6OdHTUvEXhvWbzTW06O+VQ8P2GZ4CsrqM/uHjGSBkq3TFVtI8RazbeItL8aaboKa7qut2ur6hPodlciBrTyxYwmDLr88ymAK4wMuWxwBmIpRVkVKTk7s90n8feHrbwiviiTVrZdAKq/2/d+7wzhBn0O4hcHkHg4NXNW8T6XoM6Rahex2bNbT3e6XIUQwhTK5boAodc5PevBTpd14x0Tw/oNjBpfiaLXJrrxXq9sLt7e0EMrMIolby2b/AFsgb5lBLQOSFPFUNcj1vxlY+AIbtft+s+HIdQi1vREPmLqr2klqJICxAJ8wBJl4wx2BhtYiqJPbb74raBYtpyZ1K5m1CzF/BDZ6VczyeQSAHZUjJTJIGGAPtWfYa/ovw+sZ7vUL+Yv4h1CW+s7JbKX7XIXVSY1twpkJUDn5RjPOK52fVdQ8X/FLStU8HatpsVtd+GPPWe+s3uFkja4BXCrJGVI5znPpgEVr6JL/AGX8Yr1PEM1udYvtGtYtNuAhjjmWNpDdRwhicHeY3ZNxO0oeduQnFNpvoUpNJpdToNK+J/h7Vm8uO6ntrkXMVm9pe2k1vOksgJjDRuoYBtrYbGDg88VuWmuWV9qt/psE4e9sBG1xFtI8sSAlOcYOQp6elcN8X76S4Tw/aaTdWJ1mDXbJvKuWLrFu8zaZFUhgCA2OmcfWovhoNXX4j+PRrb2Ml/s07J09HWPb5cmOHJOevf0qiT02vG/A3/JzfxP/AOwbpX/oEleyV434G/5Ob+J//YN0r/0CSvTwf8LEf4P/AG+BxYj46P8Ai/8AbZF39o251zSvCei61o2ky67Fo2sW+o3+nQZLzW8YbOAM52sUfocFQe1edat+2fovirR59I8MeD9f1rxHfRNbRabcWirFvcFcSMGPygnnj8utfTlNWNFYsFAY9SByavD4vDwpKFejzuLbT5mt++mv4MirQrSqOdKpy3Vnpf7v6Z8weGP2C/B0eiW51y+1efU5LRBMsNwixwT4Bcx4TkBsgbsjFSD9gTwUP+Zg8QZ/66w//G6+naK6HnuZNt+2episqwSSXs0ef6B8LNM8C6J4WjtTe6mnhO1uEsojsM0zSLgnPyru27lHQfNzXnfj79rGwCDw54H0rUdZ8e3p+zw6ZdWMkH2OQ8Fpg4H3evGRxyQOa+hKh+yQfavtPkx/aduzztg37c5xnrj2rkpYqm6ntMVB1H01sr3b101V3fS3qdM6E1Dkw8uT5X8tNd7LzPnjwb+w94E0rTZf7fF5r2o3VssczSz7I4JSAXaHYFI+bOCc8fjXq3wk+Emk/Brw7daLotxeXFnPePeZvXV3VmVVKghRkfIOvNdvRSxGZYvFJxrVG0+nT7ugUcFh8O06cEmuvU888cfs/eAPiRrraz4j8OxanqTRLAZ2nlQlFztGFcDjJ7V3Gk6Va6HpdnptjELeytIUt4IgSQiKAqjJ5OAB1q3RXJPEVqkI05zbitk27L0XQ3jRpwk5xik3u7as+ePFn7EHgXxP4j1DV473VtJa9laeS1spIxCrscsVDISATzjNHhP9ibwj4P8AFOka7a63rk1zpt1HdxRzSRFHZGyAwEYOOPWvoeivS/tnMOT2ftna1vkcby3COXP7NX3PkD4wfst/DnwTMNYl/wCEwnXVtQ8mDTtCjjnEUshJC/MnyoW4G5u4FTeCP2JvCvivwtp+rX8nivw7eXKFpNMvpoDNAQSMNiPvjI6HBHFfXNFdX9vY5UVTjUfMut+na366sweVYaVRzcFbtbr3ufMf/DAvgrGP+Eg8QY9PNh/+N0n/AAwJ4J/6D/iD/v7D/wDG6+naKx/t3Mv+fz/A0/srBf8APtHh/hX9k/w74O8H+KvD1hq+pTW3iJIYrqS7MblUjYkhdqr94Mw59avfFX41eB/Bmj6r4f8AHGm6np9hNC1qkElkzxX8RXGIZUJTp2ZlYegr2KoLyxttQiEV1bxXMYYMEmQOMjocHvXN9elWqqpi25630dnfRXvZ9Euhv9VjShy4dKPyuuvS/meB/sd/Dy48I+GfEGsnTrjR9M1+8S40zT7yQyXEVqikRtISB8zbicemKK+g6K58ZipYyvKvPd/povXTr1NcNQjhqUaUen/DkFlY2+nW4gtYI7eAFmEcShVBYlmOB6kk/U1XtNA02wvpL22sLeC7k37544gHbcwZsnryQCfUgVaurlLK1muJd3lRIZG2KWOAMnAGST7DmqH/AAklgNas9JMxW+u7V7yGJkYbokKBjyOCDInB55rhckt2dai3sjldF17Q7vxZ4kl1NdIs9S0zUVtoJ3ZEnZBbRkMxY5z+/kUH0OPWti1u/B9lfNeW9zo0F2zySGaOWJXLSbfMOQereWmfXaM9K17rQNLvZmmuNNtLiZusksCsx/Eiov8AhFdF/wCgPYf+Ayf4VklUWl0zZuk9bNGZpd34O0SaeXT7nRrKSf8A1rwSxIX+dn5wf70jt9XY9zTor/wjBqT6hHd6Ol85ZmuVmiEjFlRWJOc8iOMH2RfQVBrTeEfD9lqt1e2OnxxaXbi6u8WisYojuIYgLz91unpUepXXg/SIrmS60+zjS3aNXf8As/5cuyKgDbMEkyoOD39jiXUkt2v6/wCGKVOLtZP+v+HKGqeGvhprXk/brXw7cmEyGPe0PyeY5eTHPG5yWPqTmk8LWmh/EHw7qelXuk6XfaJpmpSWNnAsSyQrHEqhGXOQGG4jIxitC1uvBt5pC6pFZ2BsXnlt1l+xDl42dXGNueDG/PtXU2lnb2MAitYI7eEciOJAi/kKcXKTTureRMlGEWuV38zI0bwF4c8PWqW+m6HYWUKzLcgQ26gmUdJCcZLDJwx5rWh061t7y4u4reOO6uQommVQHkCghdx74ycfWq13r9jY61p2lTzbL7UEle2j2k7xGFL89BgMOtaNbpp3S6GDTVm+oV434G/5Ob+J/wD2DdK/9Akr2SvG/A3/ACc38T/+wbpX/oElepg/4WI/wf8At8DhxHx0f8X/ALbI9korE1zxx4c8MXKW2seINL0m4dd6xX17HC7LnGQGYEjIPPtUZ+IHhcasNLPiTSBqZlEIsvt0XnGQ9E2bs7jkcYzXCqNRq6i7eh0upBOzkjgfit8XNX8GeOdM0DTv7Lgju7Brs3Go291PlhKECBbdWI65y3FTD41tH8ZE8ISxWH9mDFi90twPP/tDyPtGwR5z5fl8bv73FdLquseCdG8cjUdR1/S7DxHHZiw8m51GONxC7hwDGzDksBg4z6Vzth4V+Fes6tJa2N7o19r/APaTau01vqEcl+twsvmM28MZAoIwV+6F+XGOK9in9X9kvaUn8L1t1f2umy89fI8+ftud8lRbrS/RLb5so6b8VvGGpeBtR8cJo2jr4ZOl3eo2UZupDdp5aM0XmjbtO/byFI256tUnin40anoMzJFp1rLjR9M1Ib2YfPc3gt3XjsqnI9+tXPD/AIN+GaT3uoaZqVpeWW6Wze0XWWmsbZrg7ZI1h8wxxmQtjaAOTgDmmw/CX4e22n6hoZvJJX1B4NPf7RrMslyhgxNFbxOzlk2cOEXBwc1pzYJT96m7J7W6XWj97ouvXy3M3HEuFlNX736/d1d9Ohd+KXi3xf4X1jw7BoEOhzWmr3aacDqXneZHOySvu+TjZtjA9cn0rnfBHxi17xT8QrrQrg6NbwWuo3Ni8EdpeNM4h3AsJdvkjJXOC3TjrXWaZ4W8JfZtOg/tubVjp14+s28l7rD3UiPGGhd9zOT5a5ZSPuhic81Q8N+GvBEWqv4i0TxTPJDc6k8rR2niF3sZbuViSnlCTyyzM33MdccVnCWHVKUJU22k0nbrfS+5c41nUUozSV1pfp1sY/jn4u+J/DOv+MJLHTdJuvD3hWC1ub5J5ZEu5o5ULP5ZAKAqAcA9enFV/Dnxr1vxD8QdS0dF0mOztNRubRLY212bmZI1JDedt8hScfxMMfWtfxn4P+G17r17rXiHW4LVrqaK3vbefWzb2lxJAAUjli8wI5UFTtYdCMjBp1t4a+H9lrkOpweKmi/t25kvYrFfELCz1B5DhysHmbJQxOCACK2jLCeySdJ81rXt1svN31Un00ZnJYj2mk1a+1+l393REfwg+LOs+OdavtM16wstIvYrZboWAE8N1BlsFHSVAJFGV/exkqSegyM5Z+O2q6V431aw13SrTS9KtBePDFKJ0uriKCNnWWFynkzbwhOxGDLnnODXdeDvhP4d8C6gbzS4bszrb/Y4DeXs1wLW33BvJhEjERpkD5Vx90egrIi+H/w+0zxVqF81xALyyMuo3Gm3Gps1tZtMrCS4Nsz7Iy6s+W2gfM3qax9pgZVajjTfK1orbP79Onf/AD0UMVGEVKavfX0+7/Ixrn4meONG8AXnizVNG0NbGSzt7yyjtbuV3jMsiARSgqAxCPnepAyMYxzVPQfjXreteOtZ0ojSIbPT7++tRb/ZbxriRIA+G80L5IJ2g4Le3Wtmz+Fvw6ttOjso75prLW4FtrCCbWpZUeFGWURWoaQgKCqnCdgO1PtPC/gPT/Gt5b2/imaDWLu7muJ9CTxC4SSaUEyZtfMxzuJxt9DWvNg3GaVN31tpstLdXtrdmfLiE4tzVtL67736LfSxxGhftU3F/wCHYb+70OGK9j0R76709ZSrpdGe3jgUMekUi3COHIOAe+DXS+N/iR46+HfhiK71ux8PJd3OqW1lBc2r3M0AjkVyxaMJ5mVKgDbndnoMVe0XwN8K9X1R7DT59J1a/i0UaBPZxags8jWUbDCSIHJJUgDefmHrSj4Y+AbjQLwf21dz29vqEUk2pv4gmea3uYcpGnnmQmMrv27cjlueTWkp4FVFak0r6q3RvRLXTr3vp6kxjiuR3qJu3frbrpr+Ft/I53Xvjb4q0jwzo2pQ2Gl3kN0LmS51RbO+FpD5bBUjZPLM0e/LfvXXYNvfIr2nRNSXWdGsL9DEyXUCTgwSiWP5lB+Vxww54PfrXmfiDwT8PIbUR614onguNOd7WS/u/Essd0izAM1tJMZQxRgoYRse2QK7HT/FXg7w94Y0t7XW9GsdACraWMq3sS25CDaI0fdgkYxgHPFcOJVGpTj7Cm07vpunqvnb09O/TQdSE37Watbv9/8AX9LqKKz5vEOlW63LS6nZxrahDOXuEAiD/cL8/Lu7Z69qK8tUpy2i/uO51IR3aPJfiJpfxE8e+MLLSNKFz4W0vT5biaXVo7tlt72JkQQqBFIsu8NvyDgDGcnIpLX4Z+OPCkWlauniu31fV9PS9hkkv7Ge8LQzyRMqIBLvOzyurMeCfSud+MPibxfZ+IvFmkaPca7b3DBbyxktLeVoY7cafIrMrhdvFxs+XOS2DiuWj8V/FNdJ1HUpv7ZXVrJ2ifT0RzGzSXNxa5QYwVUtFKMdFUHpXy1SrSVWfMpN6632t6W7X7s+tp0qzpQ5XFLTS29+9773t2R6n4E+HXjhfF+keI/EXjH+1rK3tTELD7PcWuWPmfvGjMuzf84B3KcBFxg81hSp4/8Ai14mlRJbrwZN4eb92XZzZXk4unG7YjAzR+VGB8xGGJOOc1wviLV/G1lpfiex07U/Emo63Zay0EaQ3V0kjWyRzbXG6PywuVRvkLF8YOM1v6Vrfi2+8YT6bJrOvajBdX1p5+oW8VxaxQRM4BQRvGAmVJYPGxBUZYA1Cq02lTSla+uu79d9LdNinRqJuq3G9tNNl6ba3679DftfgT43nsr+w1j4hSahb3mlXNg8UhnkWaSSMKsrJJKwG0/N8gHXHSn3PwN8dax4um1fU/GdhJaXS20Vxp8VrP5KJFLDJmFGmIRj5IGcEfMxxzXP/CKXVm+Jfhl/EOoazc3L6DDJE2pSXW4zSecZlwI/Lx8kZIkZSNq4zWVqPjjxlpvhcjSpvGGpeKG1KOfU7eayfyLdYJZpZY4SyqNrIkaFVJXay7ckkETw3s1KUH1+076fPz2+Y2sT7TljON9NeVW1fp5b/I9T8RfCHxHdfDO38L6F4rOh3Qv7m6nvoEkRpI5ZZpBGCjqwwZV6HnZzwcVm2Pwt+J2n6jrV/H4402S81KIwq81rcvHZrtVR5EZn2KQV3ZwTknORXJ+EfE/ie/8AHFo1vqHiSeyn1h/7QhvIphBADeT+SiFkACG32EhSV4UnBqrbeIPHvi3x1qFsbzX9G0q+8QLHbMYXjX+zG3xuY2H3GDWqkMcEfaG4wQTo6lCXLJRlfZWb6L1+XqZKniI80XONt3dLq/Tyv6HZn4PeMNJ8OaNIPE8Osa1pf9pNPcXkE8zXMdyB8iHzlcMoUAHf6dK9H+GWgaz4W8E6bpWu6sNbv7VDH9s8tkZowfkDbmYlguAWJycZPNfOFz4p+JehXscT3fiDVI44tTt7q5itn8tCRLbWLeu7NsspKg5aYk4BFe1fALUL7UfDWpPc3mrahZLeItlc60kgndPs0Jk5kVWKiYzAEjtgcAVvhKlJ1bQi07W1fkvPytfv6nPjKdZUbzlFq99F5vy8727eh6dXjfgb/k5v4n/9g3Sv/QJK9krntM8DaXpPjPWvFFusw1XV4YILktJlCsQITavbqc+tfU4erGlCrGX2o2XrzRf5I+XrU5TlTa+y7/g1+p5b8T/CHiSf4strmm6Xq13p76PBaGXSk06RjIk0rlHW86DDryg7nJrsP+ELeb4zWPiI6PAlguhSQvOyx7lujPGyg453BVPzDjjrXodFavHVHCMbJWTjfq0++pH1WHNKTb1af3Hn3jPwQ2t/E3wPq6aXb3NpYteG+uHRCV3QbYs55b5umM4ryPwr8L/GY8G674Ym0/VdMub2y1C3huZhpwsonkd2QiSL/SSGBxyT945HAr6dorSlmNWlTVNJNK1r+Tb7/wB5/gTPBwqT57tenol+h4Prfg7WfFfg2ew0/wCH8fgm+S40pBdQTWjTOsNyjuVCZUpEoLLvPOSNnrkah8DvE+qamYbi6up5E8VyavDrsrQpKu3TVSCcpHtHE6KhUKCQDkYOa+j6K0hmlandQSV793ukt22+ne34ESwNOVuZt29PPolbqfLdt8GPG2q+EYba+0m2t9SfRryO6tzcIIJZn1Zbo224EkJLGGGcEANg9xVyfwZ4t1vxTq2uw/D8+HRbzaTd22lxXVvtvxa3TuxLI2xJvLYKAeML97oB9MUVp/bFZ3vBbt9erTfXyW/y1M/7Op/zPa3Tordj5m1r4d+MbzULHXl8P39rJceINQ1OSzspLCe7topbWKGPcJyYSSYySAWwCOc1J43+HHinW57C+07wteNqUumW9oJryXT2hZ45XbZf2xBjCgtvDW3PzEYBAr6VopLNqsXFqEfd2327b6oby+ElJOT19N++xj6jZ65PqOlSWWpWdpZRMTfW8tm0r3A4wI33r5ffkq3WvD/Hnwi8Sa58TvEup2WnI+m689ppd3M0qAtYeSrStjOeJIgmOp8wkcZr6Ioriw2MqYWTlBLa23mn0811OqthoVklJve/4WPlh/g98Q73RfDsttp+n2V54T0Sxi0+C9cPK95Gwmm8lkfahYokJL8EE9ua3rj4S+JLjxxN4jmspZ9Mk8WQanJooNskhiEMIS5WbG/McindFuAZUOB6/RNFdrziu3flj16d2m+vdX7pt2ORZdSStd9OvZNL8H8+p8z+GfhV4z8EXeka5/Zb63c2kWrPaafG1rC2n3cryGJy42maORGAIZiUJB9hUtvgn488N+EPEPh2K3sLyPWLGxm+06adgS+guI/MkkWVzukdMuWHykxYwMjP1HRT/tivfmcY9OnZuS69G/n1uP8As6la139/dJP70v8AKx81az8L/F2maNa6NBpV1qZ0rxQ2qprVmbNrrUYJYJt0siznY0yvIEbeuCoUr042X8J6/b6tpOvXfgm58WW40afSn0rUm0+K4glM5fzWVCIAki4VinzAIuQcmvfKKzeaVZJKUF176332enfS33aFLAwT0k/w6O66fmfOfjX4QeLNdl8YXGnRS6Ra3kGjpBolm1s1vc+Tt8yMuy7lEeMAqUzjoaK+jKK6aGe4mhHljGNtOj6JLvrt1OTEZPQxElKcn+He/b8j/9kA" />
            </td>
        </tr>
    </table>
    <h2 style="font-size:24px;color:#6A5ACD;text-align:center;margin: 15px 0 20px;">CONVENTION DE STAGE</h2>

    <div style="display:flex;max-width:900px;justify-self: center;flex-direction: column;justify-content: center;padding: 0 12px;">
        <div style="height: 4px;border: 1px solid #777;border-top: 2px solid #6A5ACD;"></div>
        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 20px 0 16px;font-weight: bold;">Article 1 : Objet de la convention</h3>
        <p style="color: #000 ;line-height: 1.5;font-size: 16px;margin-top: 0;max-width:900px;margin-bottom:0;font-family: \'Times New Roman\', Times,serif;">
            La présente convention de stage a pour objet de régler les rapports entre : <br>
            - La Faculté des Sciences et Techniques de Marrakech, représentée par son Doyen Monsieur <strong style="color: #296293;">Moha TAOURIRTE</strong> <br>
            Adresse : BP 549, AV. Abdelkrim El khattabi, Guéliz, Marrakech, Maroc, <br>
            Téléphone : +212 524 43 34 04 <br>
            Fax : +212 524 43 31 70 <br>
            et désignée ci après par Etablissement.
            <br>Et<br>
            - L’Organisme ci-dessous mentionné : <br>
            Nom: <strong style="color: #296293;">' . $nomEntr . '</strong> <br>
            Adresse: <strong style="color: #296293;">' . $adrEntr . '</strong> <br>
            Téléphone: <strong style="color: #296293;">' . $telEntr . '</strong> <br>
            Représenté par: <strong style="color: #296293;">' . $nomEncd . '</strong> <br>
            Et désigné ci-après par l’Organisme. <br>
            Elle concerne : Étudiant(e) régulièrement inscrit(e) dans l’établissement pour l’année universitaire
            <strong style="color: #296293;">2022/2023</strong> <br>
            et dont la carte d’étudiant porte le numéro du CNE suivant : <strong style="color: #296293;">' . $cne . '</strong> sous le nom :
            <strong style="color: #296293;">' . $nom . ' ' . $prenom . '</strong> <br> Et dénommé ci-après le stagiaire.
        </p>
        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 2 : Objectif du stage</h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;">
            <p style="color: #000 ;line-height: 1.5;font-size: 16px;margin-top: 0;max-width:900px;margin-bottom: 0;font-family:\'Times New Roman\', Times, serif;">
                Le stage de formation a pour objet de permettre à l’étudiant de mettre en pratique les outils théoriques
                et méthodologiques acquis au cours de sa formation, d\'identifier ses compétences et de conforter son
                objectif professionnel. <br>
                Le stage s\'inscrit dans le cadre de la formation et du projet personnel et professionnel de l’étudiant.
                <br>
                Il entre dans son cursus pédagogique et est obligatoire en vue de la délivrance du diplôme.
            </p>
        </div>
        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 3 : Lieu et période du stage</h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;">
            <p style="color: #000 ;line-height: 1.5;font-size: 16px;margin-top: 0;max-width:900px;margin-bottom: 0;font-family: \'Times New Roman\',serif;">
                Le stage se déroulera du <strong style="color: #296293;">' . $datedebut . '</strong> au <strong style="color: #296293;">' . $datefin . '</strong>
                <br>
                Le stage aura lieu à <strong style="color: #296293;">' . $adrEntr . '</strong>
            </p>
        </div>
        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 4 : Statut du stagiaire – Accueil et encadrement
        </h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;color:#000">
            L’étudiant, pendant la durée de son stage dans l’Organisme, demeure étudiant de l’Établissement ; il est
            suivi régulièrement par l’Établissement. L’Organisme nomme un Encadrant chargé d’assurer le suivi technique
            et d’optimiser les conditions de réalisation du stage.
        </div>
        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;"> Article 5 : Intitulé du stage</h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;color:#000">
            Le projet de stage est intitulé : <strong style="color: #296293;">' . $intitule . '</strong> <br>
            Et son programme est établi en fonction de la spécialisation de l’étudiant. <br>
            Dans l’organisme d’accueil, le responsable de stage, chargé du suivi des travaux du stagiaire est : <br>
            Monsieur : <strong style="color: #296293;">' . $nomEncd . '</strong> <br>
            Qualité : <strong style="color: #296293;">' . $qltEncd . '</strong> <br>
            Téléphone : <strong style="color: #296293;">' . $telEntr . '</strong> <br>
            E-mail : <strong style="color: #296293;">' . $emailEncd . '</strong> <br>
            A la Faculté des Sciences et Techniques de Marrakech, le responsable de stage, chargé du suivi <br>
            des travaux du stagiaire est : <br>
            Monsieur : <strong style="color: #296293;">' . $nomResp . '</strong> <br>
            Qualité : <strong style="color: #296293;">' . $qltResp . '</strong> <br>
            Téléphone : <strong style="color: #296293;">' . $telResp . '</strong> <br>
            E-mail : <strong style="color: #296293;">' . $emailResp . '</strong> <br>
        </div>
        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 6 : Gratification</h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;color:#000">
            L’étudiant ne peut prétendre à rémunération, cependant il peut bénéficier d’une gratification. <br>
            Les frais de déplacement et d’hébergement engagés par l’étudiant à la demande de l’Organisme, ainsi
            que les frais de formation éventuellement nécessités par le stage, seront intégralement pris en charge par
            l’Organisme selon les modalités qui y sont en vigueur.
        </div>

        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 7 : Responsabilité civile et assurances</h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;color:#000">
            Le stagiaire s’engage à se couvrir par un contrat d’assurance individuelle. <br>
            Lorsque l’Organisme met un véhicule à la disposition du stagiaire, il lui incombe de vérifier
            préalablement que la police d’assurance du véhicule couvre son utilisation par un étudiant.
        </div>

        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 8 : Discipline</h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;color:#000">
            Durant son stage, l’étudiant est soumis à la discipline et au règlement intérieur de l’Organisme, notamment
            en ce qui concerne les horaires, et les règles d’hygiène et de sécurité en vigueur dans l’Organisme. <br>
            Toute sanction disciplinaire ne peut être décidée que par l’Établissement. Dans ce cas,l’Organisme informe
            l’Établissement des manquements et lui fournit éventuellement les éléments constitutifs. <br>
            En cas de manquement particulièrement grave à la discipline, l’Organisme se réserve le droit de mettre fin
            au stage de l’étudiant tout en respectant les dispositions fixées à l’article 10 de la présente convention.
        </div>

        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 9 : Fin de stage – Rapport –Evaluation</h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;color:#000">
            A l’issue du stage, l’Organisme délivre au stagiaire une attestation de stage et remplit une fiche
            d’évaluation qu’il retourne à l’Établissement. Selon les règlements pédagogiques en vigueur, l’étudiant sera
            susceptible de fournir un rapport. Ce rapport ainsi que les éventuels travaux associés pourront être
            présentés lors d’une soutenance. <br>
            Le responsable direct du stagiaire ou tout autre membre de l\'Organisme appelé à se rendre à l\'Établissement
            dans le cadre de la préparation, du déroulement et de la validation du stage ne peut prétendre à une
            quelconque prise en charge ou indemnisation de la part de l\'Établissement.
        </div>

        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 10 : Absence et Interruption du stage
            Interruption temporaire</h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;color:#000">
            Au cours du stage, le stagiaire pourra bénéficier de congés sous réserve que la durée minimale du stage soit
            respectée. <br>
            Pour toute autre interruption temporaire du stage (maladie, maternité, absenceinjustifiée...) l’Organisme
            avertira le Responsable de l’Établissement par courrier.
        </div>

        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 11 : Devoir de réserve et confidentialité</h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;color:#000">
            Le devoir de réserve est de rigueur absolue. Les étudiants stagiaires prennent donc l’engagement de
            n’utiliser en aucun cas les informations recueillies ou obtenues par eux pour en faire l’objet de
            publication, communication à des tiers sans accord préalable de la Direction de l’Organisme, y compris le
            rapport de stage. Cet engagement vaudra non seulement pour la durée du stage mais également après son
            expiration. L’étudiant s’engage à ne conserver, emporter, ou prendre copie d’aucun document ou logiciel, de
            quelque nature que ce soit, appartenant à l’Organisme, sauf accord de ce dernier.
        </div>

        <h3 style="text-decoration: underline;color: #222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 12 : Recrutement</h3>
        <div style="font-family:\'Times New Roman\',serif;font-size:16px;line-height:1.5;max-width:900px;color:#000">
            Le stagiaire n’est lié par aucun contrat de travail avec l’organisme qui l’accueille. <br>
            S’il advenait qu’un contrat de travail prenant effet avant la date de fin du stage soit signé avec
            l’Organisme la présente convention deviendrait caduque ; l’ « étudiant » ne relèverait plus de la
            responsabilité de l’Établissement. Ce dernier devrait impérativement en être averti avant la signature du
            contrat.
        </div>

        <h3 style="text-decoration: underline;color:#222;font-size: 14.5pt;margin: 14px 0;font-weight: bold;">Article 13 : Droit applicable – Tribunaux compétents
        </h3>
        <div style="font-family: \'Times New Roman\', serif;font-size:16px;line-height:1.5;">
            La présente convention est régie exclusivement par le droit marocain. Tout litige non résolu par voie
            amiable sera soumis à la compétence de la juridiction marocaine compétente.
        </div>

        <div style="display: flex;justify-content: center;margin: 20px 0;padding-left: 300px;">
            <p style="font-family: \'Noto Sans Arabic UI\',sans-serif;font-weight:bold;color:#121416;">
                Lu et approuvé Le stagiaire : <br>
                <strong style="color: #296293;">' . $nom . ' ' . $prenom . '</strong>, le ..................
        </div>
        <div style="font-family: \'Noto Sans Arabic UI\',sans-serif;font-weight:bold;margin: 20px 0;">
            Le Responsable de l\'Organisme d’Accueil ou son délégué, <br>
            <strong style="color: #296293;">' . $nomEncd . '</strong>, le ......................
        </div>
        
        <table style="margin-top: 17px;">
            <tr>
                <td style="padding-right: 60px;">
                    <p style="font-family: \'Noto Sans Arabic UI\',sans-serif;font-weight:bold;color:#121416">
                        Pour l’établissement, <br>
                        Le Responsable de la Filière <strong style="color: #296293;">' . $diplome . '</strong> <br>
                        ........................................................., le ..................
                    </p>
                </td>
                <td style="padding-left: 60px;">
                    <p style="font-family: \'Noto Sans Arabic UI\',sans-serif;font-weight:bold;color:#121416">
                        <br> Le Doyen <br>
                        Marrakech, le .....................
                    </p>
                </td>
            </tr>
        </table>
        
    </div>
</body>
</html>
';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$pdf_content = $dompdf->output();
$filename = 'Convention_' . $nom . '_' . $cne;
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $filename . '.pdf"');
header('Content-Length: ' . strlen($pdf_content));
echo $pdf_content;