using frontendApp.models;
using frontendApp.requests;
using System;


namespace frontendApp
{
    class Program
    {
        static void Main(string[] args)
        {
            BezoekerModel b = new BezoekerModel("1test", "De Plekker", "Bram", true, 2309);

            SessieModel sessie = new SessieModel("sessie1", "sessie", true, 1);
            
            //Users.getUsers();
            Users.addSessie(sessie);
                             
            //Console.ReadKey();
        }
    }
}
