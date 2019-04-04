using System;
using System.Collections;
using System.Text;
using System.Net.Http;
using System.Net.Http.Headers;
using Newtonsoft.Json.Linq;
using frontendApp.models;
using System.Net.Http.Formatting;

namespace frontendApp.requests
{
    static class Users
    {
        public async static void getUsers()
        {
            using (var client = new HttpClient())
            {
                client.DefaultRequestHeaders.Accept.Clear();
                client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue("application/json"));
                // test@testerer.de:WSTest
                var byteArray = Encoding.ASCII.GetBytes("frontender" + ":" + "frontend");

                // "basic "+ Convert.ToBase64String(byteArray)
                AuthenticationHeaderValue ahv = new AuthenticationHeaderValue("Basic", Convert.ToBase64String(byteArray));
                client.DefaultRequestHeaders.Authorization = ahv;
                using (HttpResponseMessage response = await client.GetAsync("http://10.3.56.7/wp-json/wp/v2/users"))
                {
                    using (HttpContent content = response.Content)
                    {
                        string mycontent = await content.ReadAsStringAsync();

                        JArray jsonVal = JArray.Parse(mycontent) as JArray;
                        dynamic users = jsonVal;

                        ArrayList members = new ArrayList();
                       
                        foreach(dynamic user in users)
                        {
                            members.Add(user.name);
                        }
                        Console.WriteLine(members[1]);
                    }
                }
            }
        }

        public async static void addBezoeker(BezoekerModel bezoeker)
        {
            using (var client = new HttpClient())
            {
                client.DefaultRequestHeaders.Accept.Clear();
                client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue("application/json"));
                // test@testerer.de:WSTest
                var byteArray = Encoding.ASCII.GetBytes("frontender" + ":" + "frontend");

                // "basic "+ Convert.ToBase64String(byteArray)
                AuthenticationHeaderValue ahv = new AuthenticationHeaderValue("Basic", Convert.ToBase64String(byteArray));
                client.DefaultRequestHeaders.Authorization = ahv;
                JsonMediaTypeFormatter jsonFormat = new JsonMediaTypeFormatter();
                jsonFormat.SerializerSettings.DefaultValueHandling = Newtonsoft.Json.DefaultValueHandling.Ignore;
                jsonFormat.SerializerSettings.NullValueHandling = Newtonsoft.Json.NullValueHandling.Ignore;
                using (HttpResponseMessage response = await client.PostAsync("http://10.3.56.7/wp-json/ip/bezoeker", bezoeker, jsonFormat))
                {
                    using (HttpContent httpContent = response.Content)
                    {

                        string content = await httpContent.ReadAsStringAsync();
                        int code = Int32.Parse(content);
                        if (code == 0)
                            Console.WriteLine("bezoeker is succesvol toegevoegd");
                        if (code == 1)
                            Console.WriteLine("Bezoeker kon niet worden toegevoegd");
                        if (code == 2)
                            Console.WriteLine("bezoeker bestaat al");

                        /*
                        var textContent = await content.ReadAsStringAsync();
                        dynamic json = JValue.Parse(textContent);
                        
                        UserModel u = jsonToUser(json);
                        */
                        
                    }
                }
            }


        }

        public async static void addSessie(SessieModel sessie)
        {
            using (var client = new HttpClient())
            {
                client.DefaultRequestHeaders.Accept.Clear();
                client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue("application/json"));
                // test@testerer.de:WSTest
                var byteArray = Encoding.ASCII.GetBytes("frontender" + ":" + "frontend");

                // "basic "+ Convert.ToBase64String(byteArray)
                AuthenticationHeaderValue ahv = new AuthenticationHeaderValue("Basic", Convert.ToBase64String(byteArray));
                client.DefaultRequestHeaders.Authorization = ahv;
                JsonMediaTypeFormatter jsonFormat = new JsonMediaTypeFormatter();
                jsonFormat.SerializerSettings.DefaultValueHandling = Newtonsoft.Json.DefaultValueHandling.Ignore;
                jsonFormat.SerializerSettings.NullValueHandling = Newtonsoft.Json.NullValueHandling.Ignore;
                using (HttpResponseMessage response = await client.PostAsync("http://10.3.56.7/wp-json/ip/sessie", sessie, jsonFormat))
                {
                    using (HttpContent httpContent = response.Content)
                    {

                        string content = await httpContent.ReadAsStringAsync();
                        int code = Int32.Parse(content);
                        if (code == 0)
                            Console.WriteLine("bezoeker is succesvol toegevoegd");
                        if (code == 1)
                            Console.WriteLine("Bezoeker kon niet worden toegevoegd");
                        if (code == 2)
                            Console.WriteLine("bezoeker bestaat al");

                        /*
                        var textContent = await content.ReadAsStringAsync();
                        dynamic json = JValue.Parse(textContent);
                        
                        UserModel u = jsonToUser(json);
                        */

                    }
                }
            }


        }

        private static UserModel jsonToUser(dynamic user)
        {
            int id = user.id;
            string username = user.username;
            string email = user.email;
            string first_name = user.first_name;
            string last_name = user.last_name;
            return new UserModel(id, email, username, first_name, last_name);
        }


    }
}
