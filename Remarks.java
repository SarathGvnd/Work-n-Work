class Remarks extends Exception
{							
 private static int accno[]={1001,1002,1003,1004,1005};
 private static String name[]={"Raju","Ravi","Gopi","Balu","Siva"};
 private static double bal[]={1200.00,7000.00,1400.00,10000.00,1900.00};
 Remarks(String str)
 {
  super(str);
 }
 public static void main(String args[])
 {
  System.out.println("Information Of Account Holders in SBI bank:");
  System.out.println("------------------------");
  System.out.println("Accno"+"\t"+"Name"+"\t"+"Balance");
  for(int i=0;i<5;i++)
  {
   System.out.println("------------------------");
   System.out.println(accno[i]+"\t"+name[i]+"\t"+bal[i]);
  }
  System.out.println("------------------------");
  try
  {
   for(int i=0;i<5;i++)
   {
    if(bal[i]<2000)
    {
     Remarks r=new Remarks("Account holders with less balance amount (less than 2000) are existed in SBI bank.");
     throw r;
    }
   }
  }
  catch(Remarks r)
  {
   System.out.println(r);
  }
  finally
  {
   System.out.println("The details of those account holders are:");
   System.out.println("------------------------");
   System.out.println("Accno"+"\t"+"Name"+"\t"+"Balance");
   for(int i=0;i<5;i++)
   {
    if(bal[i]<2000)
    {
     System.out.println("------------------------");
     System.out.println(accno[i]+"\t"+name[i]+"\t"+bal[i]);
    }
   }
   System.out.println("------------------------");
  }
 }
}

   