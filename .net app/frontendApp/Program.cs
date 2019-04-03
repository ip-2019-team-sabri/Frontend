using frontendApp.models;
using frontendApp.requests;
using System;


namespace frontendApp
{
    class Program
    {
        static void Main(string[] args)
        {

            UserModel u1 = new UserModel();

            u1.email = "bram.de.plekker@student.ehb.be";
            u1.first_name = "test";
            u1.last_name = "test";
            u1.username = "test";
            u1.password = "1234";
            u1.roles = "speaker";

            //Users.getUsers();
            Users.addUser(u1);
                             
            Console.ReadKey();
        }
    }
}
